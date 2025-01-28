document.getElementById("bodega").addEventListener("change", function () {
  const bodegaId = this.value;

  if (bodegaId) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "obtener_sucursales.php", true);
    xhr.onload = () => {
      var sucursales = JSON.parse(xhr.responseText);
      var sucursalSelect = document.getElementById("sucursal");

      sucursalSelect.innerHTML =
        '<option value="" hidden>Selecciona una sucursal</option>';

      sucursales.map((sucursal) => {
        var option = document.createElement("option");
        option.value = sucursal.id;
        option.textContent = sucursal.nombre;
        sucursalSelect.appendChild(option);
      });
    };
    xhr.send();
  } else {
    document.getElementById("sucursal").innerHTML =
      '<option value="" hidden>Selecciona una sucursal</option>';
  }
});

document
  .getElementById("productForm")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    const descripcion = document.getElementById("descripcion").value.trim();
    const codigo = document.getElementById("codigo").value.trim();
    const nombre = document.getElementById("nombre").value.trim();
    const precio = document.getElementById("precio").value.trim();
    const sucursal = document.getElementById("sucursal").value;
    const bodega = document.getElementById("bodega").value;
    const moneda = document.getElementById("moneda").value;
    const materiales = document.querySelectorAll(
      'input[name="materiales[]"]:checked'
    );

    const regexLetrasNumeros = /^(?=.*[a-zA-Z])(?=.*\d)/;
    const regexPrecio = /^[0-9]+(\.[0-9]{1,2})?$/;

    if (!codigo) {
      alert("El código del producto no puede estar en blanco.");
      return;
    }

    if (!nombre) {
      alert("El nombre del producto no puede estar en blanco.");
      return;
    }

    if (!bodega) {
      alert("Debe seleccionar una bodega.");
      return;
    }

    if (!sucursal) {
      alert("Debe seleccionar una sucursal para la bodega seleccionada");
      return;
    }

    if (!moneda) {
      alert("Debe seleccionar una moneda para el producto");
      return;
    }

    if (!precio) {
      alert("El precio del producto no puede estar en blanco.");
      return;
    }

    if (materiales.length < 2) {
      alert("Debe seleccionar al menos dos materiales para el producto.");
      return;
    }

    if (!descripcion) {
      alert("La descripción del producto no puede estar en blanco.");
      return;
    }

    if (codigo.length < 5 || codigo.length > 15) {
      alert("El código del producto debe tener entre 5 y 15 caracteres.");
      return;
    }

    if (nombre.length < 2 || nombre.length > 50) {
      alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
      return;
    }

    if (descripcion.length < 10 || descripcion.length > 1000) {
      alert(
        "La descripción del producto debe tener entre 10 y 1000 caracteres."
      );
      return;
    }

    if (!regexLetrasNumeros.test(codigo)) {
      alert(
        "El código del producto debe contener al menos una letra y un número."
      );
      return;
    }

    if (!regexPrecio.test(precio)) {
      alert(
        "El precio del producto debe ser un número positivo con hasta dos decimales."
      );
      return;
    }

    try {
      const response = await fetch(`verificar_codigo.php?codigo=${codigo}`);
      const data = await response.json();

      if (data.exists) {
        alert("El código del producto ya está registrado.");
        return;
      }

      const formData = new FormData(document.getElementById("productForm"));

      const submitResponse = await fetch("guardar_producto.php", {
        method: "POST",
        body: formData,
      });

      const submitData = await submitResponse.json();

      if (submitData.status === "success") {
        alert("Formulario enviado correctamente");
      } else {
        alert("Error al guardar el producto. Intenta nuevamente.");
      }
    } catch (error) {
      alert("Hubo un error al verificar el código. Intenta nuevamente.");
    }
  });

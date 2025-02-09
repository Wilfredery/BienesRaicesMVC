document.addEventListener('DOMContentLoaded', function() {
    eventListener();
    darkMode();
});

function eventListener() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navResponsive);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));

    //metodoContacto.addEventListener('click', mostrarMetodosContacto )
}

function navResponsive() {
    const nav = document.querySelector('.navegacion');

    nav.classList.toggle('mostrar');
}

function darkMode() {
    const preferDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    if (localStorage.getItem('color-mode') === 'true') {
        document.body.classList.add('dark-mode');
      } else if (localStorage.getItem('color-mode') === 'false') {
        document.body.classList.remove('dark-mode');
      } else {
     
    // If no color scheme is found in local storage
    // It will proceed to read the user's system settings
     
        if (preferDarkMode.matches) {
          document.body.classList.add('dark-mode');
        } else {
          document.body.classList.remove('dark-mode');
        }
      }

    const botonDark = document.querySelector('.dark-mode-btn');

    botonDark.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');

        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('color-mode', 'true');

        }    else {
                localStorage.setItem('color-mode', 'false');
        }
    });
}

function mostrarMetodosContacto(event) {
  
  const contactoDIV = document.querySelector('#contacto');

  if(event.target.value === 'telefono') {
    contactoDIV.innerHTML = `
    
      <label for="telefono">Numero telefonico: </label>
      <input type="tel" placeholder="Aqui colocar tu numero de telefono" id="telefono" name="contacto[telefono]">
    
      <p>Si eligió teléfono, elegir la fecha y la hora para contactarnos con usted.</p>

      <label for="fecha">Fecha: </label>
      <input type="date" id="fecha" name="contacto[fecha]">

      <label for="hora">Hora: </label>
      <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
    
    `;
  } else {
    contactoDIV.innerHTML = `
    
      <label for="email">E-mail: </label>
      <input type="email" placeholder="Aqui tu correo electronico" id="Email" name="contacto[email]">
    
    `;
  }
  
}
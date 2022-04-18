# PMTS Online Courses System

Is a WordPress Theme with special functionality for Online Course System

![theme screenshot](/screenshot.png)

Para instalar simplemente baja esta carpeta como un archivo comprimido y agrégalo como un tema nuevo en WordPress.

## Desarrollo del tema

Este tema utiliza [Sass-lang](https://sass-lang.com/) para los estilos y Javascript Vainilla. Además, el tema utiliza [Browsersync](https://browsersync.io/) para hacer la compilación del SASS a CSS y recarga automática del navegador para mejor experiencia de desarrollo.

Para continuar con el desarrollo del sitio:
1. clona este repositorio dentro de la carpeta themes de tu instalación local de WordPress.
1. Asegúrate de tener instalado Node y NPM.
1. Cambia de directorio a la carpeta recién clonada (si no le das nombre debe llamarse courses-pmts) y ejecuta el comando `npm install`.
1. Al terminar la instalación abre el archivo package.json y busca la sección "scripts".
1. Dentro encontrarás la linea "browsersync" debes cambiar el url del proxy al url donde corre tu instalación local de WordPress.
1. Una vez cambiada la url puedes ejecutar `npm run watch` en la línea de comando y ver el sitio corriendo en http://localhost:3000.
1. Toma en cuenta que tu instalación de WordPress local debe estar activa y accesible a través de un dominio local.


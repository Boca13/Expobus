# Expobus
[Software developed at the Library of the University of Seville to extend the open source web application Omeka](README.md#english)

[Software desarrollado en la Biblioteca de la Universidad de Sevilla para ampliar la aplicación de código abierto Omeka](README.md#español)

## English
(Coming soon)

## Español
### Desarrollos
#### Introducción
La Biblioteca de la Universidad de Sevilla ha desarrollado un conjunto de soluciones para ampliar las funcionalidades de la aplicación de software libre [Omeka](http://omeka.org) [(más información)](README.md#sobre-omeka), con idea de adaptarla a sus necesidades. Para ello, se han desarrollado temas y plugins.

Respecto a los plugins, se ha desarrollado uno llamado *Mosaico* para extender Exhibit Builder, de forma que haya más diseños de bloque disponibles. También se ha desarrollado uno para añadir soporte para Google Analytics.

En cuanto al estilo, se han desarrollado dos temas muy personalizables: Arguijo Y Códices. Estos temas son muy versátiles: disponen de muchas opciones que se pueden elegir individualmente para cada exposición, de forma que dos exposiciones que usan el mismo tema pueden tener un aspecto muy distinto. Lo más interesante de esto es la diversidad que se puede conseguir sin necesidad de conocimientos informáticos.

#### [Plugin Mosaic](Mosaic)
Este plugin amplía el plugin Exhibit Builder aumentando el número de diseños de bloque disponibles para las páginas de exposición, originalmente tres. Cada nuevo diseño aporta una forma distinta de introducir elementos en las exposiciones. Además, cada uno tiene distintas opciones para personalizar la apariencia.

![Diseños de bloque](Mosaic/layouts.png)

#### [Plugin Analytics](Analytics)
Es un sencillo plugin que añade a Omeka soporte para Google Analytics. Las estadísticas e informes disponibles con esta herramienta tienen un gran valor a la hora de valorar el impacto de las exposiciones. Además, conocer cómo los usuarios llegan al sitio web y su comportamiento sirve para mejorar continuamente.

#### [Tema Arguijo](arguijo)
Este tema se estrenó con la exposición sobre Juan de Arguijo. Gracias a sus opciones de personalización, se pueden crear exposiciones muy diversas. [Ejemplo](http://expobus.us.es/omeka/exhibits/show/cervantes)

#### [Tema Códices](codices)
Este tema está pensado para no sólo dar una apariencia a las exposiciones, sino que puede dar estilo a todo el sitio de Omeka. Presenta un diseño vertical y cuidado que da importancia a las imágenes al mismo tiempo que acepta grandes cantidades de texto. [Ejemplo](http://expobus.us.es/omeka/exhibits/show/codices-miniados)

#### [Herramienta de importación desde Europeana XML](europeana-xml-import)
Esta herramienta programada en VB .NET es capaz de leer los metadatos de los descriptores XML en formato Europeana de otros sitios web. De esta forma, se agiliza aún más el proceso de creación de una exposición, ya que si los elementos están ya disponibles, se podrán aprovechar sus metadatos e imagen de portada. También se pueden usar los nuevos plugins de OAI-PMH de Omeka.

### Documentación
La documentación original de Omeka puede consultarse en la [web del proyecto](http://omeka.org/codex/Documentation). Sin embargo, la Biblioteca ha redactado documentación adicional en español. También se adjunta la documentación asociada a los desarrollos mencionados arriba.
#### Documentación sobre Omeka
(En proceso de edición)
#### Documentación sobre los desarrollos propios
(En proceso de edición)

### Sobre Omeka
#### Qué es Omeka y sus ventajas
Omeka es una aplicación web gratuita y de código abierto para la publicación digital de contenidos orientada a investigadores, bibliotecarios, archiveros y museólogos. Permite poner a disposición del público archivos, colecciones y exposiciones. Es un proyecto del Roy Rosenzweig Center for History and New Media, de la Universidad George Mason. Desde aquí les agradecemos el desarrollo de este proyecto, tan útil para las instituciones bibliotecarias y museísticas.

Es muy fácil de usar: está diseñado pensando en personal sin especialización en informática, permitiendo a los usuarios centrarse en el contenido. Además, Omeka dispone de una comunidad que aporta documentación y desarrollos para ampliarlo.

Omeka es extensible, escalable y flexible: es capaz de manejar colecciones muy grandes de metadatos y archivos. Puede almacenar cualquier tipo de archivo, y los metadatos se pueden extender más allá del Dublin Core, conjunto por defecto. Estos elementos se pueden reutilizar en distintas partes del sitio web. Se pueden ampliar sus capacidades mediante el uso de los plugins, ya sea utilizando los existentes o desarrollando plugins propios. También se puede personalizar la apariencia de Omeka mediante el uso de temas existentes o propios.

Los metadatos de elementos añadidos a Omeka se pueden exportar fácilmente y se pueden recolectar mediante OAI-PMH. Además, se pueden importar elementos a Omeka de forma más sencilla mediante el uso de plugins, como por ejemplo desde archivos CSV, Dropbox o repositorios OAI-PMH. Omeka también dispone de un buscador.

#### Plugin Exhibit Builder
Es un plugin desarrollado por los creadores de Omeka. Se utiliza para crear exposiciones virtuales usando los elementos existentes en la aplicación. Cada exposición puede usar un tema distinto y se pueden configurar sus opciones individualmente. Los elementos se muestran en bloques, que a su vez se combinan formando páginas. Las páginas se pueden ordenar jerárquicamente.

Si bien las capacidades de este plugin son bastante potentes, el resultado final estará limitado al tema que se aplique y los bloques que se utilicen. Los diseños disponibles por defecto para estos bloques son muy escasos, por lo que la Biblioteca de la Universidad de Sevilla ha desarrollado una solución para ampliar la funcionalidad existente y reducir las restricciones que pudieran surgir al crear exposiciones. Sin embargo, se ha mantenido la filosofía de sencillez y facilidad de uso de Omeka.

### Guía de instalación
Con propósitos ilustrativos, se detallan a continuación los pasos necesarios para tener una instalación de Omeka para su uso por cualquier persona o institución. La siguiente información no es oficial y se pretende que sirva como guía. La documentación original debe consultarse en la [web de Omeka](http://omeka.org/codex/Documentation).

#### Requisitos
Omeka es una aplicación web en PHP que requiere un servidor con:
- Servidor HTTP, como Apache. Necesita el módulo mod_rewrite.
- Intérprete PHP con la versión 5.3.2 o superior.
- Servidor de bases de datos MySQL 5.0 o superior.
- ImageMagick, para redimensionar imágenes.
Se pueden consultar los requisitos previos a la instalación aquí. Si no se dispone de un servidor, se puede crear un sitio en [omeka.net](http://omeka.net), que ofrece distintos planes, siendo el básico gratuito.

#### Instalación de Omeka
Los pasos oficiales para la instalación sobre una máquina con pila LAMP se pueden consultar [aquí](http://omeka.org/codex/Installation).
Sin embargo, adjuntamos aquí un resumen de ejemplo orientativo de los pasos necesarios para instalar Omeka. Los comandos son para un servidor con RHEL o CentOS 7, aunque son extrapolables a otros sistemas. Se ruega hacer un uso responsable y ejecutarlos con prudencia. No proporcionamos ninguna garantía y se incluye aquí como una mera guía.
```
# Partiendo de una imagen minimal de CentOS 7.

INSTALACIÓN DE PAQUETES
1. yum -y install httpd
2. yum -y install mariadb-server mariadb
3. yum -y install php php-mysql
 
SSH
1. yum -y install openssh-server
2. service sshd start
 
ARRANQUE
1. Añadir regla firewall
	# firewall-cmd --permanent --add-service=http
	# firewall-cmd --reload
2. service httpd start
3. service mariadb start
 
 
BASE DE DATOS
1. mysql_secure_installation
2. mysql -u root -p
3. > use mysql
4. > insert into user(host, user, password) values('localhost','omeka',password('omeka'));
5. > insert into db(host,db,user,Select_priv, Insert_priv, Update_priv, Delete_priv, Create_priv, Drop_priv) values ('localhost','omeka_db','omeka','Y','Y','Y','Y','Y','Y');
6. > quit
7. mysqladmin -u root -p create omeka_db
8. mysqladmin -u root -p reload
9. mysql -u root -p
10. > ALTER DATABASE omeka_db DEFAULT CHARACTER SET 'utf8' DEFAULT COLLATE 'utf8_unicode_ci';
11. > quit
 
INSTALACIÓN DE OMEKA
1. curl -O http://omeka.org/files/omeka-2.3.zip
2. yum install unzip
3. unzip omeka-2.3.zip
4. rm omeka-2.3.zip
5. mv omeka-2.3/ /var/www/
6. cd /var/www/
7. mv omeka-2.3/ omeka
8. cd omeka
9. chown omeka . -R
10. chmod +x *.php -R
11. chmod u+w files -R
12. chgrp apache /var/www/omeka -R
!!! DESACTIVAR SELinux en /etc/selinux/config
13. setenforce 0
14. Modificar db.ini
15. Instalar ImageMagick: yum install ImageMagick
16. Cambiar idioma en application/config
17. Abrir en navegador y completar instalación
18. rm /var/www/omeka/install
 
 
ARRANQUE AUTOMÁTICO
1. chkconfig httpd on
2. chkconfig mariadb on
```

#### Instalación de los desarrollos de este repositorio
Los desarrollos de la Biblioteca son plugins y temas. Su instalación es muy sencilla: tan sólo hay que acceder al servidor con un cliente FTP o similar y subir los archivos a las carpetas correspondientes. También se puede acceder al servidor por SSH y descargar los archivos desde la línea de comandos. Los plugins deben situarse en la carpeta *plugins* del directorio de instalación de Omeka, cada uno dentro de su propia carpeta. Similarmente, los temas deben copiarse en la carpeta *themes*.

Una vez se encuentren en estos directorios, los plugins deben instalarse y activarse en el menú de plugins de Omeka, en la sección de administración. Asimismo, los temas se pueden activar en la pestaña de apariencia.

### Licencia
El contenido de este repositorio está bajo licencia Apache 2.0.

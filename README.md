# canaan-devleop WP theme starter KIT
This is a starter kit for wordpress theme and plugins devleop. It's a result of many projects and template that was built over the years.

## steps to get strated
1. ````mkdir ${name}````
1. ````cd ${name}````
1. ````wp core download````
1. ````rm -rf wp-content/plugins````
1. ````rm -rf wp-content/themes````
1. ````mkdir wp-content/plugins````
1. ````mkdir wp-content/themes````
1. ````git clone git@github.com:nemo369/canaan_empty.git temp````

1. ````rsync -vua --delete-after temp/ .````
1. ````rm -rf temp````
1. ````rm -rf .git````
1. ````composer install --no-dev --optimize-autoloader````
1. ````npm install````
1. ````npm run build````
1. ````mv example.gitignore .gitignore````
1. ````git init````

<!-- also in -->
<!-- https://github.com/nemo369/canaan_empty.git -->
## Assets

I'm compilng all the theme assets using  [vite](https://vitejs.dev/)

#### JS:
check the Index.js file in canaan theme folder. the idea behind this structre is to gernate one big JS file that will be cached. each page will have a JS class that will be loaded only if a certain DOM elment is in the page.

#### CSS:
im using 
1.Tailwind should be used before wrtiting any new lines of CSS
1. Reset CSS completely
1. SCSS for spliting files. have a look in the style.scss for better understaing of the structe.
1. [BEM](http://getbem.com/introduction/)


#### SVG:
with an svg.php file and a simple switch case

## Meta Data

Using a Third party libray called [Carbon Fields](https://docs.carbonfields.net/#/)
look at carbon.php and for example at carbon_post.php

## Post Type

look at register_post_type.php file

## Get Started 

clone and paste all this content in a brand new WP instalation.
* Make sure to add 📢
````if (file_exists(dirname(__FILE__).'/canaan_conf.class.php'))
include dirname(__FILE__).'/canaan_conf.class.php';
```` 
to wp-config.php file 📢

then go to wp-content/theme/canaan and 
1. ````npm install```` 
1. ````composer install --no-dev --optimize-autoloader```` 
1. ````npm run dev```` 

❤️



# Digital Exhibit CMS

## About
This application provides a Content Management System for developing digital exhibitions in a [Prezi](https://prezi.com)-like environment. The application was designed for highlighting so-called *Genetic Paths* (these are: chronological narratives) in literary writing processes in view of making the research of Genetic Criticism more accessible to a wider audience. You can find an example of an exhibit (in Dutch) developed using this CMS here: [http://brulez.uantwerpen.be](http://brulez.uantwerpen.be)

### Credits
The CMS was designed by the Antwerp (Belgium) based digital agency [Prophets](http://www.prophets.be/), and the development of its open source software package was part of the [University of Antwerp](https://www.uantwerpen.be/en/)'s contribution to the [DiXiT](http://dixit.uni-koeln.de) project – a [Marie Curie ITN](http://ec.europa.eu/research/mariecurieactions/about-msca/actions/itn/index_en.htm) that has received funding from the People Programme ([Marie Skłodowska-Curie Actions](http://ec.europa.eu/research/mariecurieactions/)) of the European Union's Seventh Framework Programme (FP7/2007-2013) under REA grant agreement n° 317436. Specifically, the development of the software was commissioned by DiXiT fellows Aodhán Kelly and Elli Bleeker, and their PhD supervisor Dirk Van Hulle – who were all working at the University of Antwerp's [Centre for Manuscript Genetics](https://www.uantwerpen.be/en/research-groups/centre-for-manuscript-genetics/) at the time.

After the conclusion of the DiXiT project, the CMS was provided with a series of installation instrucions (written by Jasper Vercammen – see below), and its reusability tested by developing a new exhibit on the Belgian author Hugo Claus, that was part of a local exhibit at the Flemish literary archive [Letterenhuis](https://www.letterenhuis.be/nl). The software was then made available online for further reuse on the [Center of Manuscript Genetics' GitHub page](https://github.com/centre-for-manuscript-genetics). Funding for these additional tasks was provided by [DARIAH-VL](http://be.dariah.eu/dariah-vl), the [FWO](https://www.fwo.be)-funded Flemish (Belgian) contribution to [DARIAH-EU](https://www.dariah.eu). 

### License and Reuse
The Digital Exhibit CMS is open-sourced software licensed under the [GNU License](https://www.gnu.org/licenses/gpl-3.0.en.html). 

## Installation Instructions

### Production Requirements
Your server must have following modules / packages installed. 
- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- sqlite

### Local development requirements
Make sure you have PHP installed and that it is accessible through the command line.
On Linux and OSX this comes out of the box, on Windows you're gonna have to change some settings. 
More information can be found in the [PHP docs](http://php.net/manual/fa/install.windows.commandline.php)

### Local development
This project is made with the [laravel framework](https://laravel.com/). It requires some packages which are defined in the `composer.json` file.
To install these enter the following command:
```
php composer.phar install
```

_At the end, the composer tries to optimize it's files. If this fails, because your PHP path is in a different location than `/bin/` try optimizing it yourself_
```
php artisan optimize
```

After this, you should already be good to go to start the development server: 
```
php artisan serve
```
Which should start a development server on `http://localhost:8000`
If the local server shows a `Whoops, looks like something went wrong` error rename `.env.example` file in the root to `.env`.
If you try again, you should see a more detailed error.

**Common errors**  
The cipher and / or key length are invalid. Solution: 
```
php artisan key:generate
```



#### Javascript & Styling
If you look at the folder structure, the files needed for deployment to the server are located in `/public/`. In there you will also find a `/css` and a `/js` folder. These folders contain the merged JS and (S)CSS files. 

To make changes to one of those, do NOT change the files in the public folder. 
Change the files in the `/resources/assets/js` or `/resources/assets/sass` folder.

The files are compiled on production build with GULP.
For development you can run the gulp watcher.
You are gonna need node/npm for this, so go to their website and install it: [https://nodejs.org/en/download/](https://nodejs.org/en/download/)
Once it is installed, install the packages specified in the `package.json` folder: 
```
npm install
```

This will install gulp and all the modules that gulp needs to compile JS and (S)CSS. 
You have 2 modes to run gulp: `dev` and `prod`.
If you run `dev`: 
```
npm run dev
```
Gulp will start a watcher on the JS en SCSS files. The moment you change something in the `/resources/assets/js` or `/resources/assets/sass` folder, it will compile a new version and place it in the public folder.

If you run the production task: 
```
npm run prod
```
It will run the compiler over all the files and it will create minified and uglified versions and place them in the public folder. This should be done before a production release.


#### Local setup of the application
After developing the site (or during the development) you will need to test the application. Since you cannot access the cockpit CMS via the `serve` command, we need to setup a local apache server. Easiest way to do that is installing [mamp (OSX)](https://www.mamp.info/en/) / [wamp (Windows)](http://www.wampserver.com/en/) / [lamp (Linux)](https://www.linux.com/learn/easy-lamp-server-installation). 
Once you have mamp/wamp/lamp running we are going to do a bit of setup to make it easier for accessing the website.
Inside the mamp/lamp/wamp folder you will find the apache folder (on OSX it can be found here: `/Applications/MAMP/conf/apache`). Search in that folder for the file `httpd.conf` and open it. 
Look for the line containing `httpd-vhosts.conf`. Uncomment the line so that it looks as shown below.
```
Include <path>/extra/httpd-vhosts.conf
```
Next step is to open that `httpd-vhosts.conf` file and add following snippet at the end 
```
<VirtualHost *:80>
    ServerAdmin admin@admin.pro
    DocumentRoot "<path-to-brulezarchive>/public"
    ServerName brulezarchive.be.local
    ErrorLog "logs/error_brulez.archive.local-error_log"
</VirtualHost>
```
Replace the path to the brulez archive with the correct filepath on your computer. 
That snippet will link the public folder to the servername. 

_Note: If you use port 80 on the first line, you need to make sure that your MAMP also uses port 80 in it's apache settings, if not, please change 80 to the port that MAMP uses, and when you browse to your local url add the portnumber behind: `brulezarchive.be.local:<port-number>`._

Last step is adding the servername in the host file of our computer, so the browser will look on our localhost address for the servername, and not on the world wide web. 
Opening the hostfile
```
// Windows
C:\Windows\System32\Drivers\etc\hosts

// OSX
/etc/hosts

// Linux
/etc/hosts
``` 

And add following line: 
```
127.0.0.1 brulezarchive.be.local
```
_If you have changed the servername, make sure you match the servername here as well._

Restart mamp/wamp/lamp and go to browser:
```
http://brulezarchive.be.local
```

And you should see the website.
Now you can also access `/cockpit` to setup the pages and the grid.

If you receive an error message like this: `Parse error: syntax error, unexpected T_CLASS, expecting T_STRING or T_VARIABLE or '$' in ...`
update your mamp/lamp/wamp so it uses php version 5.5 or newer. 


### Deployment to a server
If you want to deploy the website to a real server, you need to make a production build as described in the [Javascript & Styling](#Javascript-Styling) section. Once that is done, you can move the public folder to the server. 

To upload files and other media via the cockpit CMS, you've got to make sure that the `cockpit/storage` folder had write access on the server.





# digitalexhibit

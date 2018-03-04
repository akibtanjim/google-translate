# Laravel Google Translator

This package is built for laravel with a view to translate any text from source language to destination language using Google Translate.

## Installation
Go to your ```composer.json``` file and paste the below line after **config** array if they don't exist :

```
    "minimum-stability": "dev",
    "prefer-stable": true
```   

Install using composer:
```

composer require "akibtanjim/google-translate":"*"

```

After updating composer, add the ServiceProvider to the providers array in ```config/app.php```

In the **providers** section add the below line:

```

  Akib\Translate\GoogleTranslateServiceProvider::class,

```
add the Alias to **aliases** section of config/app.php:

```

  'TranslateText'=>Akib\Translate\Facades\GoogleTranslate::class,

```

### Useage

Create a new directory ```app/Helper``` and create a new file named ```Functions.php``` there. Then paste the code below

```
<?php

  function sessionFlush(){
    Session::forget('source');
    Session::forget('target');
  }

  function setTarget($target){
    Session::put('target',$target);
  }

  function setSource($source){
    Session::put('source',$source);
  }

  function translateText($text){
    $src = Session::get('source');
    $target = Session::get('target');
    if($target == '' || $target == null) return $text;
    if($src == '' || $src == null) 
    {
      $src= env('BaseLanguage');
      Session::put('source',env('BaseLanguage'));
    }
    if($src == $target) return $text;
    else{
      $translation=TranslateText::translate($src,$target,$text);
      return $translation;
    }
  }
?>

```
Open your ```composer.json``` file and add the below line of code under ```autoload``` section:

```
        "psr-4": {
            "App\\": "app/",
            "Akib\\Translate\\": "vendor/akibtanjim/google-translate/src"
        },
        "files": [
          "app/Helpers/Functions.php"
        ]
```
Now open your command promt and run the following comment.

```

  composer dump-autoload

```

### Example

Open command prompt and wrtie the following command:

```

  php artisan make:controller ExampleController

```
Now paste the following code:

```

  <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Session;

    class ExampleController extends Controller
    {
        public function index(){
          return view('test');
        }

        public function setTarget(Request $request){
          Session::put('target',$request->target);
          return 1;
        }
    }
  ?>

```

Now create a view file in the ```resources/views/test.blade.php``` and paste the below code:

```
  Language: 
  <select name="target" class="target">
    <option>Select</option>
    <option value="bn">Bangla</option>
    <option value="en">English</option>
    <option value="zh-CN">Chinese</option>
  </select><br>

  <p>
    {{ translateText("Hello World") }}
  </p>
  <script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
  <script type="text/javascript">
    $('.target').on('change',function(){
          var target = $(this).val();
          $.ajax({
              url:"{{url('/setTarget')}}",
              type:"POST",
              dataType:'json',
              data:{"_token": "{{ csrf_token() }}","target":target},
              success: function(data) {
                location.reload();
              },
              error: function(e) {

              }
          });
      });
  </script>
```
In your ```web.php``` paste the following code.
```
  Route::get('/demo', 'ExampleController@index');
  Route::post('/setTarget', 'ExampleController@setTarget');
  
```
Now open your ```.env``` file and paste the follwing code:
```
  BaseLanguage=bn
```
Open command prompt and run:
```
  php artisan serve
```
Open the follwing link in your browser and change the language and see translation in action.
```
  http://127.0.0.1:8000/demo
```

## Supported Languages and their shortcode


| Language  					| Short Code 		|
| ----------------------------- | ----------------- |					
|Afrikaans						|	af              |
|Albanian						|	sq				|
|Amharic						|	am 				|
|Arabic							|	ar 				|
|Armenian						|	hy 				|
|Azeerbaijani					|	az 				|
|Basque							|	eu 				|
|Belarusian						|	be 				|
|Bengali						|	bn 				|
|Bosnian						|	bs           	|
|Bulgarian						|	bg 				|
|Catalan						|	ca 				|
|Cebuano						|	ceb (ISO-639-2) |
|Chinese (Simplified)			|	zh-CN (BCP-47)  |
|Chinese (Traditional)			|	zh-TW (BCP-47)  |
|Corsican						|	co              |
|Croatian						|	hr 				|
|Czech							|	cs 				|
|Danish							|	da  			|
|Dutch							|	nl  			|
|English						|	en 				|
|Esperanto						|	eo 				|
|Estonian						|	et 				|
|Finnish						|	fi 				|
|French							|	fr 				|
|Frisian						|	fy 				|
|Galician						|	gl 				|
|Georgian						|	ka 				|
|German							|	de 				|
|Greek							|	el 				|
|Gujarati						|	gu 				|
|Haitian Creole					|	ht 				|
|Hausa							|	ha 				|
|Hawaiian						|	haw (ISO-639-2) |
|Hebrew							|	iw 				|
|Hindi							|	hi 				|
|Hmong							|	hmn (ISO-639-2) |
|Hungarian						|	hu 				|
|Icelandic						|	is 				|
|Igbo							|	ig 				|
|Indonesian						|	id 				|
|Irish							|	ga 				|
|Italian						|	it 				|
|Japanese						|	ja 				|
|Javanese						|	jw 				|
|Kannada						|	kn 				|
|Kazakh							|	kk 				|
|Khmer							|	km 				|
|Korean							|	ko 				|
|Kurdish						|	ku 				|
|Kyrgyz							|	ky 				|
|Lao							|	lo 				|
|Latvian						|	la 				|
|Latvian						|	lv 				|
|Lithuanian						|	lt 				|
|Luxembourgish					|	lb 				|
|Macedonian						|	mk 				|
|Malagasy						|	mg 				|
|Malay 							|	ms 				|
|Malayalam						|	ml 				|
|Maltese						|	mt 				|
|Maori							|	mi 				|
|Marathi						|	mr 				|
|Mongolian						|	mn 				|
|Myanmar (Burmese)				|	my 				|
|Nepali							|	ne 				|
|Norwegian						|	no 				|
|Nyanja (Chichewa)				|	ny 				|
|Pashto							|	ps 				|
|Persian						|	fa 				|
|Polish							|	pl 				|
|Portuguese (Portugal, Brazil)	|	pt 				|
|Punjabi						|	pa 				| 						
|Romanian						|	ro 				|
|Russian						|	ru 				|
|Samoan							|	sm 				|
|Scots Gaelic					|	gd 				|
|Serbian						|	sr 				|
|Sesotho						|	st 				|
|Shona							|	sn 				|
|Sindhi							|	sd 				|
|Sinhala (Sinhalese)			|	si 				|
|Slovak							|	sk 				|
|Slovenian						|	sl 				|
|Somali							|	so 				|
|Spanish						|	es 				|
|Sundanese						|	su 				|
|Swahili						|	sw 				|
|Swedish						|	sv 				|
|Tagalog (Filipino)				|	tl 				|
|Tajik							|	tg 				|
|Tamil							|	ta 				|
|Telugu							|	te 				|
|Thai							|	th 				|
|Turkish						|	tr 				|
|Ukrainian						|	uk 				|
|Urdu							|	ur 				|
|Uzbek							|	uz 				|
|Vietnamese						|	vi 				|
|Welsh							|	cy 				|
|Xhosa							|	xh 				|
|Yiddish						|	yi 				|
|Yoruba							|	yo 				|
|Zulu							|	zu 				|

## Limitations:
* This package can only translate upto 5000 characters at a time.

## Authors

* **Akib Tanjim** - [akibtanjim](https://github.com/akibtanjim)

## Acknowledgments

* [statickidz/php-google-translate-free](https://github.com/statickidz/php-google-translate-free)

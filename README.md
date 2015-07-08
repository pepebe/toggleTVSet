# toggleTVSet
Toggle visibility of a set of TVs depending on the value of a Single Select TV

This plugin will toggle the visibility of a number of TVs depending on the value of a select TV.

See this quickcast for a short introduction:

http://quick.as/dvdkfjwo

**Use case**

In one of your templates you want to be able to select one of four different headers.

Each type of header needs one or more TVs but you only want to show the TVs needed for the selected type of header.

Inside your template you want to use different chunks for templating.

** Note: ** At the moment you have to manualy setup the plugin. Just follow the steps below.

# Example Setup

You have four different headers (Simple, Jumbotron,Carousel,Cover). For each one of them you use different TVs.

## Step 1 - Create your header TVs

### Simple Header TV

* Header_Headline (6) - a simple Text TV

### Jumbotron TVs

* Jumbotron_Background_Color (7) - Colorpicker TV
* Jumbotron_Background_Image (8) - Image TV
* Jumbotron_RTE (9) - Richtext TV

### Carousel TVs

* Carousel_Gallery (10) - MIGX TV

### Cover TVs

* Cover_Background_Image (11) - Image TV
* Cover_RTE (12) - Richtext TV

### Header Select TV

Header (13) - Single Select TV
* Input Option Values:"Standard==6||Jumbotron==7,8,9||Carousel==10||Cover==11,12"
* Allow Blank: false
* Default: 6
* Enable typeahead: false

Give each input option a label and add the ids of the TVs used as comma separated values.

** Note: **  Be careful not to add empty spaces inside the value!

```
Bad: "Standard==6||Jumbotron== 7 , 8, 9 ||Carousel==10||Cover==11,12"
Good: "Standard==6||Jumbotron==7,8,9||Carousel==10||Cover==11,12"
```

## Step 2 - Add toogleTVSet to your MODx Manager.

1. Copy the code found in **core/components/ppb_toggletvset/elements/plugins/toggletvset.plugin.php** into to a new plugin and trigger it on **OnDocFormPreRender**.
2. Modify the selectTV variable in line 12 to match the id of your Header Select TV.
3. Done.

# getTVLabel.snippet.php

This snippet will retrieve the label of the selected TV value. 

You have a selectTV with these input options: "Standard==4||Carousel==8||Cover==9,10||Jumbotron==5,6,7"

In your template you want to use 

```
[[$[[*selectTV]]]]
```

to call 

```
* [[$Standard]] or [[$Carousel]].
```

As the values of your Tv only show the ids of the involved TVs, you want to return the label of the current value instead.

Example:
```
[[$[[*selectTV]]]] returns [[$4]]
[[$[[*selectTV:getTVLabel]]]] returns [[$Standard]] 
```

# getTVNames.snippet.php

Output filter to retrieve names of TVs from a list of TV ids.

This is a simple output filter. 
You can use it in snippets like getResources or pdoTools to add TVs to your query.

Example:
```
&includeTVs=`[[*selectTV:getTVNames]]`
```

Advanced options:
------------------------------------------------------
If your TV is not prefixed, use the snippet like this:
```
[[+selectTV:getTVNames]]
```

If you are working in getResources/pdoResources, etc and your TV is prefixed (example [[+tv.selectTV]], etc.), use it like this:
```
[[+tv.selectTV:getTVNames=`tv.`]]
```

# Changelog

* v0.0.1 Initial release
* v0.0.2 Corrected cut and paste mishap
* v0.0.3 More cut and paste mishap (don't work in multiple tabs...)
* v0.0.4 Minor changes to js to clean up code. New instructions
* v0.0.5 Completely recoded the plugin. The plugin will work now on any tab.

# 2do

* Multiple sets of TVs that can be toggled.


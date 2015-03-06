<?php
/*
toggleTVSet plugin for modx v0.0.4 (2015-03-06 10:31)
info@pepebe.de

Changelog:
-----------------------------
v0.0.1 Initial release
v0.0.2 Corrected cut and paste mishap
v0.0.3 More cut and paste mishap (don't work in multiple tabs...)
v0.0.4 Minor changes to js to clean up code. New instructions

Todo:
-----------------------------
Add iterator to handle more than one group of TV Sets.

Usage:
------------------------------
1. Add plugin to modx manager.
2. Check OnDocFormPreRender Event
3. Setup Header TVs (Example):
  * Standard_Headline (4)
  * Jumbotron_BG_Color (5)
  * Jumbotron_BG_Image (6)
  * Jumbotron_RTE (7)
  * Carousel_MIGX_TV (8)
  * Cover_Background_Image (9)
  * Cover_RTE (10)
4. Setup Select TV used for picking header type:
  * Name: Header
  * Type: Single Select TV
  * Input Option Values: "Standard==4||Carousel==8||Cover==9,10||Jumbotron==5,6,7"
  * Allow blank: false
  * Enable typeahead: false
  * Move it to the very top of your List of TVs
5. Done!
*/

$selectTV = "tv11"; // Add the id of your Header Single Select Here
$tab = 'modx-panel-resource-tv';
$tab = 'modx-resource-settings';
/* No changes below this line. */

$js = "
    Ext.onReady(function () {

        function toggleTVSet(tvs,displayValue){
            for(x in tvs){
                if (typeof tvs[x] !== 'function') {
                    var tvId = 'tv' + tvs[x].trim() + '-tr';
                    var tv = Ext.get(tvId);
                    if(tv){
                        tv.setStyle('display',displayValue);
                    }
                }
            }
            console.log('toggleTVSet triggered tvs(' + tvs + ') set to display: ' + displayValue );
        }
    
        Ext.getCmp('modx-resource-tabs').on('tabchange',function(e){
        
            console.log('tab event');
            console.log(e.getActiveTab().id);
                
            if(e.getActiveTab().id == '".$tab."'){

                var selectTV = Ext.getCmp('".$selectTV."');
                
                var hideTVs = selectTV.store.data.keys.join().split(',')
                var showTVs = selectTV.getValue().split(',')
                
                toggleTVSet(hideTVs , 'none');
                toggleTVSet(showTVs , 'block');
                
                selectTV.on('select',function(selectTV){
                
                    hideTVs = selectTV.store.data.keys.join().split(',')
                    showTVs = selectTV.getValue().split(',')
                    
                    toggleTVSet(hideTVs , 'none');                
                    toggleTVSet(showTVs , 'block');
                });
            }
        });
    });
";

$modx->regClientStartupHTMLBlock('<script>'.$js.'</script>');

return;
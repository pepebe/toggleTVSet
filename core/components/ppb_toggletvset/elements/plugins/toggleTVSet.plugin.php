<?php

/* v0.0.5*/

/* 
    Extjs Documentation
    http://docs-origin.sencha.com/extjs/3.4.0/#!/api/Ext.Panel 
    http://docs-origin.sencha.com/extjs/3.4.0/#!/api/Ext.TabPanel
*/

/* Make changes to this part */
$debug = 'false';
$selectTV = 11; // Add the id of your Header Single Select Here

/* No changes below this line. */

$selectTV = 'tv'.$selectTV;

$js = "
    Ext.onReady(function () {
        var debug = ".$debug.";

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
            if(debug){
                console.log('toggleTVSet triggered tvs(' + tvs + ') set to display: ' + displayValue );
            }
        }
    
  
        
        if(debug){
            var mpr = Ext.getCmp('modx-panel-resource');
            var mrt = Ext.getCmp('modx-resource-tabs');
            Ext.util.Observable.capture(mpr, function(evname) {console.log(evname, arguments);});
            Ext.util.Observable.capture(mrt, function(evname) {console.log(evname, arguments);});
        }
        
        /*
        Ext.getCmp('modx-panel-resource').on('afterlayout',function(e){
            //console.log('panel afterlayout');
        });
        */
        

        
        Ext.getCmp('modx-resource-tabs').on('tabchange',function(e){
            if(debug){
                console.log(e.getActiveTab().id);
            }
        });
        
        Ext.getCmp('modx-resource-tabs').on('afterlayout',function(e){
        
            var selectTV = Ext.getCmp('".$selectTV."');
            
            if(selectTV){
            
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

$css = "
    /* Some fixes for css bugs in manager*/
    #modx-resource-settings .modx-tv  {padding-left: 0!important}
";
$modx->regClientStartupHTMLBlock('<style>'.$css.'</style>');

return;
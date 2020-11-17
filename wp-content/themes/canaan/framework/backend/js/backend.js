$(document).click(function() {
    // console.log('rsvp dev');
    
    if($('.cf-image').length>0 && typeof canaanAttachments!='undefined'){
        $('.cf-image').each(function(){
            var val=$(this).find('input').val();
            $(this).find('input').removeAttr('readonly');
           
           $(this).find('.cf-field__body').find('.canaan_error').remove();
           if(typeof canaanAttachments[val]!='undefined'){
               var imgData=canaanAttachments[val];
                var label=$(this).find('.cf-field__label').text();
                 
                var dbImageWidth=imgData[0];
                var dbImageHeight=imgData[1];
                 
                var isError=false;  
                var errMessage=[];
                
                if( label.indexOf('{') >= 0 && label.indexOf('}') >= 0){
                    var label = label.substring(
                            label.lastIndexOf("{")+1 , 
                            label.lastIndexOf("}")
                        );
                        
                       
                        
                        var labelArray = label.split(',');
                        if( label.indexOf('min-width:') >= 0 || label.indexOf('max-width:') >= 0  || label.indexOf('max-height:') >= 0  || label.indexOf('min-height:') >= 0){
                               var currMinImgWidth=0;
                               var currMaxImgWidth=0;
                               var currMinImgHeight=0;
                               var currMaxImgHeight=0;
                               for(var i=0;i<labelArray.length;i++){
                                   if(labelArray[i].indexOf('min-width:') >= 0){
                                       currMinImgWidth= labelArray[i].replace('min-width:','');
                                   }
                                   if(labelArray[i].indexOf('max-width:') >= 0){
                                       currMaxImgWidth= labelArray[i].replace('max-width:','');
                                   }
                                   if(labelArray[i].indexOf('min-height:') >= 0){
                                       currMinImgHeight= labelArray[i].replace('min-height:','');
                                   }
                                   if(labelArray[i].indexOf('max-height:') >= 0){
                                       currMaxImgHeight= labelArray[i].replace('max-height:','');
                                   }
                               }
                               
                               if(dbImageWidth<currMinImgWidth){
                                   errMessage.push('Image is smaller than the requested width');
                                   isError=true;  
                               }
                               if(dbImageWidth>currMaxImgWidth){
                                   errMessage.push('Image is bigger than the requested width');
                                   isError=true;  
                               }
                               if(dbImageHeight<currMinImgHeight){
                                   errMessage.push('Image is smaller than the requested height');
                                   isError=true;  
                               }
                               if(dbImageHeight>currMaxImgHeight){
                                   errMessage.push('Image is bigger than the requested height');
                                   isError=true;  
                               }
                          
                               
                               
                               
                            
                        }else{
                        
                            var currImgWidth=0;
                            var currImgHeight=0;
                            
                             for(var i=0;i<labelArray.length;i++){
                                if(labelArray[i].indexOf('width:') >= 0){
                                    currImgWidth= labelArray[i].replace('width:','');
                                }
                                if(labelArray[i].indexOf('height:') >= 0){
                                    currImgHeight= labelArray[i].replace('height:','');
                                }
                            }




                            
                            /*
                            if( label.indexOf('width:') >= 0){
                                var widthIndex=0;
                                if(labelArray[1].indexOf('width:') >= 0){
                                    widthIndex=1;
                                }

                                currImgWidth = labelArray[widthIndex].replace('width:','');
                            }
                            if( label.indexOf('height:') >= 0){

                                   var heightIndex=0;
                                if(labelArray[1].indexOf('height:') >= 0){
                                    heightIndex=1;
                                }

                                currImgHeight = labelArray[heightIndex].replace('height:','');
                            }
                            */
                            
                             
                                 if(currImgWidth>0 && currImgWidth!=dbImageWidth){
                                       errMessage.push('Wrong Image width, please choose another image');
                                        isError=true;  
                                   
                                      }
                             
                                    if(currImgHeight>0 && currImgHeight!=dbImageHeight){
                                                    errMessage.push('Wrong Image height, please choose another image');
                                        isError=true;  
                                          
                                    }



                        }
                  
                
                
             
             
                if(isError){
                    for(var i=0;i<errMessage.length;i++){
                        $(this).find('.cf-field__body').append('<strong class="canaan_error">'+errMessage[i]+'</strong>');
                    }
                    
                    $(this).find('.cf-file__content').find('img').attr('src',noImgSrch);
                    $(this).find('input').val('');
                }
                  
              }
          
        }
            
        });
    }
});
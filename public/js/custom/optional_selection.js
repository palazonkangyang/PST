
function loadAddPerson(selector, selected, addclass, wrapaddclass, suggestion){
	$(selector).on('click', function(e,i){



				getselector = $(this);


			        	getid = suggestion.data.id;
			        	selid = $(addclass).find('input').get(0);
			        	compid = $('input[name^=otheroption]');

			        	if(selid){

			        		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelected(addclass,selected,suggestion,'otheroption');
                  document.getElementById("select_otheroption").value = '';
                  findTotal();
                  calTotal();
			        		}

			          	} else {
			          		if(!existPerson(compid, getid, this.value)){
			        			errDisp(wrapaddclass, 'Already added on the list!', '6000');
			        		}else {
			        			appendSelected(addclass,selected,suggestion,'otheroption');
                          document.getElementById("select_otheroption").value = '';
                      findTotal();
                      calTotal();
			        		}

			          		//appendSelected(addclass,selected,suggestion,'approver');
						}
            });
}

function findTotal(){
    var arr = document.getElementsByClassName('oo_price_cal');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    $(".oo_total").text(tot);
    $("#oo_total").val(tot);

}

function calTotal(){
    var oo_total = document.getElementById('oo_total');
    var szp_ss_price = document.getElementById('szp_ss_price');
    var szp_price = document.getElementById('szp_price');
    var tot=0;
    tot = parseInt(document.getElementById('oo_total').value)+  parseInt(document.getElementById('szp_ss_price').value)+parseInt(document.getElementById('szp_price').value);

    $(".total").text(tot);
    $("#total").val(tot);
    $(".total_gst").text((tot*0.07).toFixed(2));
    $(".total_aftergst").text((tot*1.07).toFixed(2));
  $("#total_aftergst").val((tot*1.07).toFixed(2));

}


function loadRemovePerson(selector){

	$(selector).on('click', function(e,i){
    	$('span.numbering_method').remove();

		  findTotal();
    calTotal();

	});
}


function errDisp(selector, errmsg, speed){
	speed = speed || "3000";

	$(selector).html('<span class="alert alert-danger tp">'+errmsg+'</span>');
	setTimeout(function(){
	  $(selector+ '> span').remove();
	}, speed);
}

function existPerson(a,b){
	isValid = true;
		a.each(function() {
		  if(b == this.value){
		  	isValid = false;
		  }
		});
	return isValid;
}

function appendSelected(a,b,c,d){
  $('span.numbering_method').remove();

	$(a).append('<div><i class="fa fa-minus-circle minus-'+d+'"></i> '+c.value+ '<input type="hidden" name="otheroption_name[]" value="'+c.data.id+ '"><input type="hidden" class="oo_price_cal" name="otheroption_price[]" value="'+c.data.price+'" /></div>');
	var str = document.getElementById('otheroption_text').value;
	var otheroption_text = str.replace('<br>'+c.value, "");
	$("#otheroption_text").val(document.getElementById('otheroption_text').value+'<br>'+ c.value);

	$(b).hide();
	loadRemovePerson('.minus-'+d);


}

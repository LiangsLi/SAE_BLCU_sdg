//ʹ��Jquery���ص���  
function loadPopup(){    //���ڿ�����־popupStatusΪ0������¼���   
	if(popupStatus==0){    
		$("#backgroundPopup").css({    
			"opacity": "0.7"   
		});    
		$("#backgroundPopup").fadeIn("slow");    
		$("#popupContact").fadeIn("slow");    
		popupStatus = 1;    
	}    
}

//ʹ��Jqueryȥ������Ч��  
function disablePopup(){    //���ڿ�����־popupStatusΪ1�������ȥ�� 
	if(popupStatus==1){    
		$("#backgroundPopup").fadeOut("slow");    
		$("#popupContact").fadeOut("slow");    
		popupStatus = 0;    
	}    
}   

function centerPopup(){   //���������ڶ�λ����Ļ������
	//��ȡϵͳ����
	var windowWidth = document.documentElement.clientWidth;   
	var windowHeight = document.documentElement.clientHeight;   
	var popupHeight = $("#popupContact").height();   
	var popupWidth = $("#popupContact").width();   
	//��������   
	$("#popupContact").css({   
		"position": "absolute",   
		"top": windowHeight/2-popupHeight/2,   
		"left": windowWidth/2-popupWidth/2   
	});   
	//���´������IE6����Ч  
	$("#backgroundPopup").css({   
		"height": windowHeight   
	});   
}

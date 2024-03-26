<?php
// traduz os dias da semana no ACF
function translateWeekDay($name_field=''){
	if($name_field == ''){
		return 'Preencha o nome do campo';
	} else {
		switch($name_field){
			case('Sunday'): 	return 'Domingo'; 	break;
			case('Monday'): 	return 'Segunda'; 	break;
			case('Tuesday'): 	return 'Terça'; 	break;
			case('Wednesday'): 	return 'Quarta'; 	break;
			case('Thursday'): 	return 'Quinta'; 	break;
			case('Friday'): 	return 'Sexta'; 	break;
			case('Saturday'): 	return 'Sábado'; 	break;
		}
	}
}
//  modo de uso: echo translateMonthDay($valorDoDia)

//Traduzir Mês no ACF
function translateMonthDay($name_field=''){
	switch($name_field){
		case('January'): 	return "Janeiro"; 	break;
		case('February'): 	return "Fevereiro"; break;
		case('March'): 		return "Março"; 	break;
		case('April'): 		return "Abril"; 	break;
		case('May'): 		return "Maio"; 		break;
		case('June'): 		return "Junho"; 	break;
		case('July'): 		return "Junho"; 	break;
		case('August'): 	return "Agosto"; 	break;
		case('September'): 	return "Setembro"; 	break;
		case('October'): 	return "Outubro"; 	break;
		case('November'): 	return "Novembro"; 	break;
		case('December'): 	return "Dezembro"; 	break;
	}
}
// modo de uso: echo translateMonthDay($valorDoMes)

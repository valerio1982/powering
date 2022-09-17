/**
 * 
 */
var full = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');
var contatore = 0;
var today = new Date();

var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
var riferimento = 1;
var lastId=0;
var lastInsertedRowId = 0;

$(document).ready(function(){



});//fine di $(document).ready(function()




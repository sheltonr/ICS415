var backgroundColor = 'None';
var headerImage = 'None';
var curr = 0;
var answers;
var questions;
var answers;
$(function() {
	$('#answer').hide();
	$('.carousel').carousel({
		interval: 5000
	});
	$('#toggle').click(function() {
		if ($('#answer').is(':visible')) {
			$('#answer').hide(next());
			$('#toggle').text('Show answer');
			$('#toggle').attr('class', 'btn btn-success btn-sm');
		} else {
			$('#answer').show();
			$('#toggle').text('Next question');
			$('#toggle').attr('class', 'btn btn-danger btn-sm');
		}
	});

});

function background(color) {
	if (color != 'None') {
		$('html, body').css('background-image', 'url(images/backgrounds/'+color+'.jpg)');
		$('html, body').css('background-repeat', 'repeat');
		backgroundColor = color;
	} else {
		$('html, body').css('background-image', color);
		backgroundColor = color;
	}
	$('#background').val(backgroundColor);
}

function header(image) {
	if (image != 'None') {
		$('#myheader').css('background-image', 'url(images/headers/'+image+'.jpg)');
		headerImage = image;
	} else {
		$('#myheader').css('background-image', image);
		headerImage = image;
	}
	$('#header').val(headerImage);
}

function next() {
	if (curr < answers.length) {
		$('#answer').text(answers[random[curr]]);
		$('#question').text(questions[random[curr]]);
	curr++;
	} else {
		$('#answer').hide('slow');
		$('#question').text('Trivia done!');
		$('#answer').text('Yes, it is true.');
	}
}

function set(myAnswers, myQuestions, myRandom) {
	answers= myAnswers;
	questions = myQuestions;
	random = myRandom;	
}
		

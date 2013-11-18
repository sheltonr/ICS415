var selected = 'None';
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
			$('#answer').hide('fast', 'linear', next());
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
	if (color != 'none') {
		$('html body').css('background-image', 'url(images/'+color+'.jpg)');
		$('html body').css('background-repeat', 'repeat');
		selected = color;
	} else {
		$('html body').css('background-image', color);
		selected = color;
	}
	$('#background').val(selected);
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
		

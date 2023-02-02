$(function () {
  $('.js-ask-question-call').on('click', function () {
    $.fancybox.open({
      src: '/local/ajax/components/ask_question_form.php',
      type: 'ajax'
    });
  });
});
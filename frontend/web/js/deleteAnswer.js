$(document).ready(function () {
    $('a.button-delete').click(function () {
        var params = {
            'id': $(this).attr('data-id'),
            'QuestionId': $(this).attr('data-QuestionId'),
        };
        $.post('/question/default/delete-answer', params, function (data) {});
        return false;
    });
});


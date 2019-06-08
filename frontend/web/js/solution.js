$(document).ready(function () {
    $('a.button-solution').click(function () {
        var params = {
            'id': $(this).attr('data-id'),
            'QuestionId': $(this).attr('data-QuestionId'),
            'UserId': $(this).attr('data-UserId')
        };
        $.post('/question/default/solution', params, function (data) {});
        return false;
    });
});


$(function () {
    $(".js-search-btn").on("click", function () {
        // 処理内容
        const companyId = $(".js-search-company-id").val();
        $.ajax({
            type: 'GET',
            url: 'search',
            data: {
                'company_id': companyId, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
            },
            dataType: 'json'
        }).done(function (data) {
            console.log(data);
        }).fail(function () {
            console.log('どんまい！');
        })
    });
})

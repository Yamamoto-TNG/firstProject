$(function () {
    const $searchButton = $('.js-search-btn')

    $searchButton.on("click", function () {
        // 処理内容
        const keyword = $(".js-search-keyword").val();
        const companyId = $(".js-search-company-id").val();

        $.ajax({
            type: 'GET',
            url: 'search',
            data: {
                'keyword' : keyword,
                'company_id': companyId, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
            },
            dataType: 'json',
        })
        .done((data) => {
            console.log(data);
        })
        .fail( () => {
            console.log('failure');
        })
    });
})

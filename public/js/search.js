$(function () {
    const $searchButton = $('.js-search-btn')

    $searchButton.on("click", function () {
        // 処理内容
        $('.js-tbody').empty();
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
                for(let i in data) {
                    //会社名の取得
                    $.ajax({
                        type: 'GET',
                        url: `getCompanyName/${data[i].company_id}`,
                        dataType: 'json',
                    })
                    .done((companyData) => {
                        html = `
                            <tr class= "list">
                                <td>${data[i].id}</td>
                                <td><img src=${data[i].img_path} alt=${data[i].product_name}
                                width="100" height="100" class="img-thumbnail"></td>
                                <td>${data[i].product_name}</td>
                                <td>${data[i].price}</td>
                                <td>${data[i].stock}</td>
                                <td>${companyData.company_name}</td>
                                <div class="d-flex"><td><a class="btn btn-outline-warning" href="/firstProject/public/detail/${data[i].id}">詳細</a></td></div>
                            </tr>
                        `;
                        $('.js-tbody').append(html);
                    })
                    .fail( () => {
                        console.log('failure');
                    });
                }
            })
             .fail( () => {
                console.log('failure');
            })
    });
});

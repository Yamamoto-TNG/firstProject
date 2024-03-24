$(function () {
    const $searchButton = $('.js-search-btn')

    $searchButton.on("click", function () {
        // 処理内容
        $('.js-tbody').empty();
        var keyword = $(".js-search-keyword").val();
        var companyId = $(".js-search-company-id").val();
        var lowerPrice = $(".js-search-lower-price").val();
        var upperPrice = $(".js-search-upper-price").val();
        var lowerStock = $(".js-search-lower-stock").val();
        var upperStock = $(".js-search-upper-stock").val();

        $.ajax({
            type: 'GET',
            url: 'search',
            data: {
                //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
                'keyword' : keyword,
                'company_id': companyId,
                'lower_price' : lowerPrice,
                'upper_price' : upperPrice,
                'lower_stock' : lowerStock,
                'upper_stock' : upperStock
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

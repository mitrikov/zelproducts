ymaps.ready(init);

function init() {
    let myPlacemark,
        myMap = new ymaps.Map('map', {
            center: [55.991196, 37.180466],
            zoom: 12.35
        }, {
            searchControlProvider: 'yandex#search'
        });

   let zelproductsDeliveryZone = new ymaps.GeoObject({
    // Описываем геометрию геообъекта.
    geometry: {
        // Тип геометрии - "Многоугольник".
        type: "Polygon",
        // Указываем координаты вершин многоугольника.
        coordinates: [
            // Координаты вершин внешнего контура.
            [
                [
                    55.95339419685462,
                    37.21273325586587
                ],
                [
                    55.979923201239174,
                    37.22161892979258
                ],
                [
                    55.97284998921219,
                    37.26183273177898
                ],
                [
                    55.980718601616736,
                    37.26539470535077
                ],
                [
                    55.98230055208534,
                    37.26802327018544
                ],
                [
                    55.99403898146008,
                    37.25887412193208
                ],
                [
                    55.99827795790699,
                    37.247458640364684
                ],
                [
                    56.040566978974006,
                    37.24625701072603
                ],
                [
                    56.04209233739769,
                    37.23961387353336
                ],
                [
                    56.03971714981669,
                    37.22803944709686
                ],
                [
                    56.015271263909696,
                    37.2041356003562
                ],
                [
                    56.02129856735636,
                    37.18897575500406
                ],
                [
                    56.01897308963153,
                    37.185596171645344
                ],
                [
                    56.01788172005179,
                    37.15535690627398
                ],
                [
                    56.011367045296396,
                    37.13735928378404
                ],
                [
                    55.99542127090645,
                    37.153841458180814
                ],
                [
                    55.990352106661014,
                    37.093416653493435
                ],
                [
                    55.98010951627205,
                    37.068748377183454
                ],
                [
                    55.97049295576029,
                    37.086646757939924
                ],
                [
                    55.969832327060395,
                    37.14639168426126
                ],
                [
                    55.964657493339935,
                    37.14575331851566
                ],
                [
                    55.953231672347975,
                    37.20294319296151
                ],
                [
                    55.94924810433829,
                    37.201932000162905
                ],
                [
                    55.94881917279888,
                    37.21959971094401
                ],
                [
                    55.95211806052237,
                    37.21897207403452
                ],
                [
                    55.95339419685462,
                    37.21273325586587
                ]
            ],
        // Задаем правило заливки внутренних контуров по алгоритму "nonZero".
        //fillRule: "nonZero"
        ]
    },
    // Описываем свойства геообъекта.
    properties:{
        // Содержимое балуна.
        //balloonContent: "Многоугольник"
    }
}, {
        description: "Зона доставки — Зеленоград",
        fill : true,
        fillColor: "#ed4543",
        fillOpacity: 0.05, 
        strokeColor:"#ed4543",
        strokeWidth: 2,
        strokeOpacity: 0.9,
        hasBalloon : false,
        hasHint : false,
        openBalloonOnClick : false,
        openHintOnHover : false,
        interactivityModel : 'default#transparent'
});

    // let coordewe = [[37.21273325586587,55.95339419685462],[37.22161892979258,55.979923201239174],[37.26183273177898,55.97284998921219],[37.26539470535077,55.980718601616736],[37.26802327018544,55.98230055208534],[37.25887412193208,55.99403898146008],[37.247458640364684,55.99827795790699],[37.24625701072603,56.040566978974006],[37.23961387353336,56.04209233739769],[37.22803944709686,56.03971714981669],[37.2041356003562,56.015271263909696],[37.18897575500406,56.02129856735636],[37.185596171645344,56.01897308963153],[37.15535690627398,56.01788172005179],[37.13735928378404,56.011367045296396],[37.153841458180814,55.99542127090645],[37.093416653493435,55.990352106661014],[37.068748377183454,55.98010951627205],[37.086646757939924,55.97049295576029],[37.14639168426126,55.969832327060395],[37.14575331851566,55.964657493339935],[37.20294319296151,55.953231672347975],[37.201932000162905,55.94924810433829],[37.21959971094401,55.94881917279888],[37.21897207403452,55.95211806052237],[37.21273325586587,55.95339419685462]];
    // let coordewe2 = [];
    // for(let i = 0; i <coordewe.length; i++) {
    //     coordewe2[i] = [coordewe[i][1], coordewe[i][0]];
    // }
    // console.log(coordewe2);
    myMap.geoObjects.add(zelproductsDeliveryZone);
    // Слушаем клик на карте.
    zelproductsDeliveryZone.events.add('click', function (e) {
        var coords = e.get('coords');

        // Если метка уже создана – просто передвигаем ее.
        if (myPlacemark) {
            myPlacemark.geometry.setCoordinates(coords);
        }
        // Если нет – создаем.
        else {
            myPlacemark = createPlacemark(coords);
            myMap.geoObjects.add(myPlacemark);
            
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
        }
        getAddress(coords);
    });

    // Создание метки.
    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
            iconCaption: 'поиск...'
        }, {
            preset: 'islands#violetDotIconWithCaption',
            draggable: true
        });
    }

    // Определяем адрес по координатам (обратное геокодирование).
    function getAddress(coords) {
        myPlacemark.properties.set('iconCaption', 'поиск...');
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);
            var addressField = document.querySelector('#billing_address_1');
            var regions = new RegExp("Россия, |Московская область, |Москва, |рабочий |городской округ Солнечногорск, ", "gi");
            var addressOfDelivery = firstGeoObject.getAddressLine().replace(regions, '');
            
            myPlacemark.properties
                .set({
                    // Формируем строку с данными об объекте.
                    iconCaption: [
                        // Название населенного пункта или вышестоящее административно-территориальное образование.
                        firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                        // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                        firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                    ].filter(Boolean).join(', '),
                    // В качестве контента балуна задаем строку с адресом объекта.
                    balloonContent: firstGeoObject.getAddressLine()
                });

                addressField.value = addressOfDelivery;//firstGeoObject.getLocalities() +  street + number;
        });
    }
}
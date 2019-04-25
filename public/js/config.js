var config = {
    services: {
        getSearchResponse: '/payments/getSearchResponse',     //получение данных платежей.
        getMerchants: '/merchants/getlistByName',     //поиск мерчантов для таблицы платежей (выдает лимитированное кол-во).
        applyRole: '/settings/applyRole', // Применение новой роли к польоователю
        statusUpdate: '/settings/statusUpdate' //изменение статуса пользователя
    },

};
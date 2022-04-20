function get(endpoint, params="") {
    
        return jQuery.ajax({

            type: "GET",
            url: endpoint,
            data: {
                req: params
            },
            dataType: "html"

        })

}


function post(endpoint, params="") {

    return jQuery.ajax({

        type: "POST",
        url: endpoint,
        data: {
            req: params
        },
        dataType: "html"

    })

}


function put(endpoint, params="") {

    return jQuery.ajax({

        type: "PUT",
        url: endpoint,
        data: {
            req: params
        },
        dataType: "html"

    })

}




export {get, post, put}
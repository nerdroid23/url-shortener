    var Ziggy = {
        namedRoutes: {"register":{"uri":"register","methods":["POST"],"domain":null},"login":{"uri":"login","methods":["POST"],"domain":null},"logout":{"uri":"logout","methods":["POST"],"domain":null},"password.email":{"uri":"password\/email","methods":["POST"],"domain":null},"password.update":{"uri":"password\/confirm","methods":["POST"],"domain":null},"urls.index":{"uri":"urls","methods":["GET","HEAD"],"domain":null},"urls.store":{"uri":"urls","methods":["POST"],"domain":null},"urls.show":{"uri":"urls\/{url}","methods":["GET","HEAD"],"domain":null},"urls.destroy":{"uri":"urls\/{url}","methods":["DELETE"],"domain":null}},
        baseUrl: 'http://url-shortener.test/',
        baseProtocol: 'http',
        baseDomain: 'url-shortener.test',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }

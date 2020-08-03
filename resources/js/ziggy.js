var Ziggy = {
  namedRoutes: {"urls.index":{"uri":"api\/urls","methods":["GET","HEAD"],"domain":null},"urls.store":{"uri":"api\/urls","methods":["POST"],"domain":null},"urls.show":{"uri":"api\/urls\/{url}","methods":["GET","HEAD"],"domain":null},"urls.destroy":{"uri":"api\/urls\/{url}","methods":["DELETE"],"domain":null}},
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

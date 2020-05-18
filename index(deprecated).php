<?php

	$frijolescharros->get(name: 'api.sales.get', path: '/api/sales', function($request) {});
	$frijolescharros->post(name: 'api.sales.post', path: '/api/sales', function($request) {});
	$frijolescharros->patch(name: 'api.sales.patch', path: '/api/sales{id}', function($request) {});
	$frijolescharros->delete(name: 'api.sales.delete', path: '/api/sales{id}', function($request) {});

	$frijolescharros->get(name: 'api.vendors.get', path: '/api/vendors', function($request) {});
	$frijolescharros->post(name: 'api.vendors.post', path: '/api/vendors', function($request) {});
	$frijolescharros->patch(name: 'api.vendors.patch', path: '/api/vendors{id}', function($request) {});
	$frijolescharros->delete(name: 'api.vendors.delete', path: '/api/vendors{id}', function($request) {});

	$frijolescharros->get(name: 'api.products.get', path: '/api/products', function($request) {});
	$frijolescharros->post(name: 'api.products.post', path: '/api/products', function($request) {});
	$frijolescharros->patch(name: 'api.products.patch', path: '/api/products{id}', function($request) {});
	$frijolescharros->delete(name: 'api.products.delete', path: '/api/products{id}', function($request) {});
?>
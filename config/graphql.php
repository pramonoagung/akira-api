<?php


return [

	/*
	 * The prefix for routes
	 */
	'prefix' => 'graphql',

	/*
	 * The domain for routes
	 */
	'domain' => null,

	/*
	 * The routes to make GraphQL request. Either a string that will apply
	 * to both query and mutation or an array containing the key 'query' and/or
	 * 'mutation' with the according Route
	 *
	 * Example:
	 *
	 * Same route for both query and mutation
	 *
	 * 'routes' => [
	 *     'query' => 'query/{graphql_schema?}',
	 *     'mutation' => 'mutation/{graphql_schema?}',
	 *      mutation' => 'graphiql'
	 * ]
	 *
	 * you can also disable routes by setting routes to null
	 *
	 * 'routes' => null,
	 */
	'routes' => '{graphql_schema?}',

	/*
	 * The controller to use in GraphQL requests. Either a string that will apply
	 * to both query and mutation or an array containing the key 'query' and/or
	 * 'mutation' with the according Controller and method
	 *
	 * Example:
	 *
	 * 'controllers' => [
	 *     'query' => '\Folklore\GraphQL\GraphQLController@query',
	 *     'mutation' => '\Folklore\GraphQL\GraphQLController@mutation'
	 * ]
	 */
	'controllers' => \Folklore\GraphQL\GraphQLController::class.'@query',

	/*
	 * The name of the input variable that contain variables when you query the
	 * endpoint. Most libraries use "variables", you can change it here in case you need it.
	 * In previous versions, the default used to be "params"
	 */
	'variables_input_name' => 'variables',

	/*
	 * Any middleware for the 'graphql' route group
	 */
	'middleware' => [
	],

	/**
	 * Any middleware for a specific 'graphql' schema
	 */
	'middleware_schema' => [
		'me' => ['authenticate'],
	],

	/*
	 * Any headers that will be added to the response returned by the default controller
	 */
	'headers' => [],

	/*
	 * Any JSON encoding options when returning a response from the default controller
	 * See http://php.net/manual/function.json-encode.php for the full list of options
	 */
	'json_encoding_options' => 0,

	/*
	 * Config for GraphiQL (see (https://github.com/graphql/graphiql).
	 * To disable GraphiQL, set this to null
	 */
	'graphiql' => [
		'routes' 			=> '/graphiql/{graphql_schema?}',
		'controller' 		=> \Folklore\GraphQL\GraphQLController::class.'@graphiql',
		'middleware' 		=> [],
		'view' 				=> 'graphql::graphiql',
		'composer' 			=> \Folklore\GraphQL\View\GraphiQLComposer::class,
	],

	/*
	 * The name of the default schema used when no arguments are provided
	 * to GraphQL::schema() or when the route is used without the graphql_schema
	 * parameter
	 */
	'schema' => 'default',

	/*
	 * The schemas for query and/or mutation. It expects an array to provide
	 * both the 'query' fields and the 'mutation' fields. You can also
	 * provide an GraphQL\Type\Schema object directly.
	 *
	 * Example:
	 *
	 * 'schemas' => [
	 *     'default' => new Schema($config)
	 * ]
	 *
	 * or
	 *
	 * 'schemas' => [
	 *     'default' => [
	 *         'query' => [
	 *              'users' => 'App\GraphQL\Query\UsersQuery'
	 *          ],
	 *          'mutation' => [
	 *
	 *          ]
	 *     ]
	 * ]
	 */
	'schemas' => [
		'default'=> [
			'query' => 	[
				//////////////////////
				// Version		 	//
				//////////////////////
				'users'				=> App\GraphQL\Query\User\UsersQuery::class,
				'headerReservasi'	=> App\GraphQL\Query\Reservasi\ReservasiHQ::class,
				'statusReservasi'	=> App\GraphQL\Query\Reservasi\ReservasiSQ::class,
				'detailReservasi'	=> App\GraphQL\Query\Reservasi\ReservasiDQ::class,
				'HeaderTransaksi' 	=> App\GraphQL\Query\Pembayaran\HeaderQuery::class,
                'Pembayaran' 		=> App\GraphQL\Query\Pembayaran\PembayaranQuery::class,
                'DetailTransaksi' 	=> App\GraphQL\Query\Pembayaran\DetailQuery::class,
                'Voucher' 			=> App\GraphQL\Query\Voucher\VoucherQuery::class,
				'Kepemilikan' 		=> App\GraphQL\Query\Voucher\KepemilikanQuery::class,
				'produk'			=> App\GraphQL\Query\Produk\ProdukQ::class,
				'cekProduk'			=> App\GraphQL\Query\Produk\CekProdukQ::class,
				'terapis'			=> App\GraphQL\Query\Terapis\TerapisQ::class,
				'cekTerapis'		=> App\GraphQL\Query\Terapis\CekTerapisQ::class,
				'KaryawanQuery'		=> App\GraphQL\Query\Manajemen\KaryawanQuery::class,
				'KetersediaanTerapisQuery'		=> App\GraphQL\Query\Manajemen\KetersediaanTerapisQuery::class,
				'PenempatanQuery'		=> App\GraphQL\Query\Manajemen\PenempatanQuery::class,
				'WorkshiftQuery'		=> App\GraphQL\Query\Manajemen\WorkshiftQuery::class,
				'CheckVoucherQuery'		=> App\GraphQL\Query\Voucher\CheckVoucherQuery::class,
				'CekKetersediaanTerapis'=> App\GraphQL\Query\Manajemen\CekKetersediaanTerapis::class,
				'AboutQuery'			=> App\GraphQL\Query\About\AboutQuery::class,
				'rating'				=> App\GraphQL\Query\Terapis\Rating::class

			],
			'mutation' => [
				/*
					USER
				 */
				'Authenticate'		=> App\GraphQL\Mutation\User\Authenticate::class,
				'StoreUser'			=> App\GraphQL\Mutation\User\StoreUser::class,
				'AddUser'			=> App\GraphQL\Mutation\User\AddUser::class,
				'AddOrganization'	=> App\GraphQL\Mutation\User\AddOrganization::class,
				'RemoveOrganization'=> App\GraphQL\Mutation\User\RemoveOrganization::class,
				'AddScope'			=> App\GraphQL\Mutation\User\AddScope::class,
				'RemoveScope'		=> App\GraphQL\Mutation\User\RemoveScope::class,
				'Deactivate'		=> App\GraphQL\Mutation\User\Deactivate::class,
				'resetPassword'		=> App\GraphQL\mutation\User\ResetPassword::class,
				'changeProfile'		=> App\GraphQL\mutation\User\ChangeProfile::class,
				'forgetPassword'	=> App\GraphQL\mutation\User\ForgetPassword::class,
				'logoutUser'		=> App\GraphQL\mutation\User\LogoutUser::class,
				'pushnotif'			=> App\GraphQL\mutation\notifikasi\SendNotification::class,
				'broadcast'			=> App\GraphQL\mutation\notifikasi\GlobalBroadcast::class,

				'createHeaderReservasi'	=> App\GraphQL\Mutation\Reservasi\HeaderRCM::class,
				'updateHeaderReservasi'	=> App\GraphQL\Mutation\Reservasi\HeaderRUM::class,
				'deleteHeaderReservasi'	=> App\GraphQL\Mutation\Reservasi\HeaderRDM::class,
				'batalReservasi'	=> App\GraphQL\Mutation\Reservasi\BatalReservasi::class,

				// 'createTerapis'	=> App\GraphQL\Mutation\Terapis\TerapisCM::class,
				// 'updateTerapis'	=> App\GraphQL\Mutation\Terapis\TerapisUM::class,
				// 'deleteTerapis'	=> App\GraphQL\Mutation\Terapis\TerapisDM::class,

				'createStatusReservasi'	=> App\GraphQL\Mutation\Reservasi\StatusRCM::class,
				'updateStatusReservasi'	=> App\GraphQL\Mutation\Reservasi\StatusRUM::class,
				'deleteStatusReservasi'	=> App\GraphQL\Mutation\Reservasi\StatusRDM::class,
				'TerimaReservasi'	=> App\GraphQL\Mutation\Reservasi\TerimaReservasi::class,
				'TolakReservasi'	=> App\GraphQL\Mutation\Reservasi\TolakReservasi::class,
				'CheckinReservasi'	=> App\GraphQL\Mutation\Reservasi\CheckinReservasi::class,

				'createDetailReservasi'	=> App\GraphQL\Mutation\Reservasi\DetailRCM::class,
				'updateDetailReservasi'	=> App\GraphQL\Mutation\Reservasi\DetailRUM::class,
				'deleteDetailReservasi'	=> App\GraphQL\Mutation\Reservasi\DetailRDM::class,

				'CreateHeader' => App\GraphQL\Mutation\Pembayaran\CreateHeader::class,
				'UpdateHeader' => App\GraphQL\Mutation\Pembayaran\UpdateHeader::class,
				'DeleteHeader' => App\GraphQL\Mutation\Pembayaran\DeleteHeader::class,

                'CreatePembayaran' => App\GraphQL\Mutation\Pembayaran\CreatePembayaran::class,
                'UpdatePembayaran' => App\GraphQL\Mutation\Pembayaran\UpdatePembayaran::class,
                'DeletePembayaran' => App\GraphQL\Mutation\Pembayaran\DeletePembayaran::class,

                'CreateDetail' => App\GraphQL\Mutation\Pembayaran\CreateDetail::class,
                'UpdateDetail' => App\GraphQL\Mutation\Pembayaran\UpdateDetail::class,
                'DeleteDetail' => App\GraphQL\Mutation\Pembayaran\DeleteDetail::class,

                'CreateVoucher' => App\GraphQL\Mutation\Voucher\CreateVoucher::class,
                'UpdateVoucher' => App\GraphQL\Mutation\Voucher\UpdateVoucher::class,
                'DeleteVoucher' => App\GraphQL\Mutation\Voucher\DeleteVoucher::class,
                'UpdateOwner' => App\GraphQL\Mutation\Voucher\UpdateOwner::class,

                'CreateKepemilikan' => App\GraphQL\Mutation\Voucher\CreateKepemilikan::class,
                'UpdateKepemilikan' => App\GraphQL\Mutation\Voucher\UpdateKepemilikan::class,
                
				'createProduk'	=> App\GraphQL\Mutation\Produk\ProdukCM::class,
				'updateProduk'	=> App\GraphQL\Mutation\Produk\ProdukUM::class,
				'deleteProduk'	=> App\GraphQL\Mutation\Produk\ProdukDM::class,

				'CreateKaryawan' => App\GraphQL\Mutation\Manajemen\CreateKaryawan::class,
				'CreateKetersediaanTerapis' => App\GraphQL\Mutation\Manajemen\CreateKetersediaanTerapis::class,
				'CreatePenempatan' => App\GraphQL\Mutation\Manajemen\CreatePenempatan::class,
				'CreateWorkshift' => App\GraphQL\Mutation\Manajemen\CreateWorkshift::class,

				'UpdateKaryawan' => App\GraphQL\Mutation\Manajemen\UpdateKaryawan::class,
				'UpdateKetersediaanTerapis' => App\GraphQL\Mutation\Manajemen\UpdateKetersediaanTerapis::class,
				'UpdatePenempatan' => App\GraphQL\Mutation\Manajemen\UpdatePenempatan::class,
				'UpdateWorkshift' => App\GraphQL\Mutation\Manajemen\UpdateWorkshift::class,
				'EnableWorkshift' => App\GraphQL\Mutation\Manajemen\EnableWorkshift::class,
				'DisableWorkshift' => App\GraphQL\Mutation\Manajemen\DisableWorkshift::class,

				'DeleteKaryawan' => App\GraphQL\Mutation\Manajemen\DeleteKaryawan::class,
				'DeleteKetersediaanTerapis' => App\GraphQL\Mutation\Manajemen\DeleteKetersediaanTerapis::class,
				'DeletePenempatan' => App\GraphQL\Mutation\Manajemen\DeletePenempatan::class,
				'DeleteWorkshift' => App\GraphQL\Mutation\Manajemen\DeleteWorkshift::class,
				'createRating' => App\GraphQL\Mutation\Terapis\CreateRating::class,
				'UpdateAbout' => App\GraphQL\Mutation\About\UpdateAbout::class

			],
		],
		'me' => [
			'query' => [
				
			],
			'mutation' => [

				
			]
		]
	],

	/*
	 * Additional resolvers which can also be used with shorthand building of the schema
	 * using \GraphQL\Utils::BuildSchema feature
	 *
	 * Example:
	 *
	 * 'resolvers' => [
	 *     'default' => [
	 *         'echo' => function ($root, $args, $context) {
	 *              return 'Echo: ' . $args['message'];
	 *          },
	 *     ],
	 * ],
	 */
	'resolvers' => [
		'default' => [
		],
	],

	/*
	 * Overrides the default field resolver
	 * Useful to setup default loading of eager relationships
	 *
	 * Example:
	 *
	 * 'defaultFieldResolver' => function ($root, $args, $context, $info) {
	 *     // take a look at the defaultFieldResolver in
	 *     // https://github.com/webonyx/graphql-php/blob/master/src/Executor/Executor.php
	 * },
	 */
	'defaultFieldResolver' => null,

	/*
	 * The types available in the application. You can access them from the
	 * facade like this: GraphQL::type('user')
	 *
	 * Example:
	 *
	 * 'types' => [
	 *     'user' => 'App\GraphQL\Type\UserType'
	 * ]
	 *
	 * or without specifying a key (it will use the ->name property of your type)
	 *
	 * 'types' =>
	 *     'App\GraphQL\Type\UserType'
	 * ]
	 */
	'types' => [
		// Gate
		App\GraphQL\Type\User\InputLogin::class,
		App\GraphQL\Type\User\User::class,
		App\GraphQL\Type\User\UserOrganization::class,
		App\GraphQL\Type\User\Login::class,
		App\GraphQL\Type\User\Authorization::class,
		App\GraphQL\Type\User\IUser::class,
		App\GraphQL\Type\User\IUserOrganization::class,
		App\GraphQL\Type\User\IUserOrganizationScope::class,
		App\GraphQL\Type\Reservasi\ReservasiDT::class,
		App\GraphQL\Type\Reservasi\ReservasiHT::class,
		App\GraphQL\Type\Reservasi\ReservasiST::class,
		App\GraphQL\Type\Reservasi\TolakReservasiType::class,
		App\GraphQL\Type\Reservasi\TerimaReservasiType::class,
		App\GraphQL\Type\Reservasi\CheckinReservasiType::class,
		App\GraphQL\Type\Reservasi\BatalReservasiType::class,
		App\GraphQL\Type\Pembayaran\DetailType::class,
		App\GraphQL\Type\Pembayaran\HeaderType::class,
		App\GraphQL\Type\Pembayaran\PembayaranType::class,
		App\GraphQL\Type\Voucher\KepemilikanType::class,
		App\GraphQL\Type\Voucher\VoucherType::class,
		App\GraphQL\Type\Voucher\CheckVoucherType::class,
		App\GraphQL\Type\Produk\ProdukT::class,
		App\GraphQL\Type\Terapis\TerapisT::class,
		App\GraphQL\Type\Terapis\CekTerapisT::class,
		App\GraphQL\Type\Produk\CekProdukT::class,
		App\GraphQL\Type\Manajemen\KaryawanType::class,
		App\GraphQL\Type\Manajemen\KetersediaanTerapisType::class,
		App\GraphQL\Type\Manajemen\PenempatanType::class,
		App\GraphQL\Type\Manajemen\WorkshiftType::class,
		App\GraphQL\Type\Manajemen\CekKetersediaanTerapisType::class,
		App\GraphQL\Type\About\AboutType::class,
		App\GraphQL\Type\Terapis\Rating::class,
		App\GraphQL\Type\Notifikasi\Notifikasi::class
	],

	/*
	 * This callable will receive all the Exception objects that are caught by GraphQL.
	 * The method should return an array representing the error.
	 *
	 * Typically:
	 *
	 * [
	 *     'message' => '',
	 *     'locations' => []
	 * ]
	 */
	'error_formatter' => [\App\GraphQL\Libraries\ErrorHandler::class, 'formatError'],

	/*
	 * Options to limit the query complexity and depth. See the doc
	 * @ https://github.com/webonyx/graphql-php#security
	 * for details. Disabled by default.
	 */
	'security' => [
		'query_max_complexity' => null,
		'query_max_depth' => null,
		'disable_introspection' => false
	]
];

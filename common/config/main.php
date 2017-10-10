<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'extensions' => require (__DIR__ . '/../../vendor/yiisoft/extensions.php'),
	'modules' => [
		'social' => [
				//Clase del módulo
				'class' => 'kartik\social\Module',
				//la configuraión global para el widget 'disqus'
				'disqus' => [
						'settings' => ['shortname' => 'DISQUS_SHORTNAME'] //configuracion por defecto
				],
				//Configuracion global para widget de los plugins de Facebook
				'facebook' => [
						'appId' => '691209991078909',
						'secret' => '188c866083879eb635e306cbf4086da6'
						
				],
				// la configuraci�n global para el widget del plugin de google
				'google' => [
						'clientId' => 'GOOGLE_API_CLIENT_ID',
						'pageId' => 'GOOGLE_PLUS_PAGE_ID',
						'profileId' => 'GOOGLE_PLUS_PROFILE_ID',
				],
				// la configuraci�n global para el widget del plugin de google analytic
				'googleAnalytics' => [
						'id' => 'TRACKING_ID',
						'domain' => 'TRACKING_DOMAIN',
				],
				// la configuraci�n global para el widget del plugin de twitter
				'twitter' => [
						'screenName' => 'TWITTER_SCREEN_NAME'
				],
		],
	],
		'components' => [
		        'assetManager' => [
		            'bundles' => [
		                //use bootstrap css from CDN
                        'yii\bootstrap\BootstrapAsset'=>[
                            'sourcePath'=>null,
                            'css'=>['https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css']
                        ],
                        // use fontawesome css from CDN
                        'frontend\assets\FontAwesomeAsset' => [
                            'sourcePath' => null, // do not use file from our server
                            'css' => [
                                'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css']
                        ],
                        // use fontawesome css from CDN
                        'backend\assets\FontAwesomeAsset' => [
                            'sourcePath' => null, // do not use file from our server
                            'css' => [
                                'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css']
                        ],
                        // use bootstrap js from CDN
                        'yii\bootstrap\BootstrapPluginAsset' => [
                            'sourcePath' => null, // do not use file from our server
                            'js' => ['https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js']
                        ],
                        // use jquery from CDN
                        'yii\web\JqueryAsset' => [
                            'sourcePath' => null, // do not publish the bundle
                            'js' => [
                                'https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
                            ]
                        ],
                    ],
                ],
				'cache' => [
						'class' => 'yii\caching\FileCache',
				],
				
				'micomponente' => [
						'class' => 'componentes\MiComponente',
				],
                'faqwidget' => [
                    'class' => 'componentes\FaqWidget',
                ],
                'authClientCollection' => [
                    'class' => 'yii\authclient\Collection',
                    'clients' => [
                        'facebook' => [
                            'class' => 'yii\authclient\clients\Facebook',
                            'clientId' => '691209991078909',
                            'clientSecret' => '188c866083879eb635e306cbf4086da6',
                        ],
                        'github' => [
                            'class' => 'yii\authclient\clients\GitHub',
                            'clientId' => 'Iv1.32ce1c69f9983b7e',
                            'clientSecret' => '45a0e4c1bd74a15d24d9c8eee937be2586aeb4da',
                        ],
                        'twitter' => [
                            'class' => 'yii\authclient\clients\Twitter',
                            'consumerKey' => 'dZEob4YCCqE22EamUalWiKOFZ',
                            'consumerSecret' => '8bNipUqNCDFLvZA0rf5brd6Jyvia0M4PHadVtttxgVGdAIdSWt',
                        ],

                        'google' => [
                            'class' => 'yii\authclient\clients\Google',
                            'clientId' => '132204697099-g8f48prtdevp7u0gnvgrg0jtcg05itut.apps.googleusercontent.com',
                            'clientSecret' => 'TAUwUof-iQMqyK-l8tG8rKNZ',
                        ],

                        'linkedin' => [
                            'class' => 'yii\authclient\clients\LinkedIn',
                            'clientId' => '78iq0wm7m4oncc',
                            'clientSecret' => 'FRfaWGdQuzDtP0Nz',
                        ],

                    ],
                ],
                'carouselwidget' => [
                    'class' => 'components\CarouselWidget',
                 ],
				
		],
];

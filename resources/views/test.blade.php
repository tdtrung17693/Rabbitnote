<!DOCTYPE html>
<html lang="en_US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test VueRouter</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/g/animatecss@3.5.1(animate.css),bootstrap@3.3.6(css/bootstrap.min.css)" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <app></app>

        <script src="https://cdn.jsdelivr.net/g/jquery@3.0.0-beta1,vue@1.0.16,vue.router@0.7.11,bootstrap@3.3.6"></script>
        <script>
            var App = Vue.extend({
                template:  '<div class="panel panel-default">\
                                <div class="panel-body">\
                                    Basic panel example\
                                    <ul>\
                                        <li><a v-link="{ path: \'/comp1\' }">Comp 1</a></li>\
                                        <li><a v-link="{ path: \'/comp2\' }">Comp 2</a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                            <router-view></router-view>'
            });

            var CompOne = Vue.extend({
                template:  '<h2>Component 1</h2>\
                            <ul>\
                                <li v-for="e in es">@{{ e }}</li>\
                            </ul>',
                route: {
                    data: function () {
                        var a = new Promise((res, rej) => { setTimeout(() => res(1), 1500); });
                        var b = new Promise((res, rej) => { setTimeout(() => res(2), 3000); });

                        return Promise.all([a,b]).then((val) => ({
                            es: val
                        }));
                    }
                }
            });

            var CompTwo = Vue.extend({
                template: '<h2>Component 2</h2>'
            });

            var Router = new VueRouter();

            Router.map({
                '/': {
                    component: CompOne
                },
                '/comp1': {
                    component: CompOne
                },
                '/comp2': {
                    component: CompTwo
                }
            });

            Router.start(App, 'app');
        </script>
    </body>
</html>
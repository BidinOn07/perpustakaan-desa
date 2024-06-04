import 'package:clustering_apps/app/utils/mainpage.dart';
import 'package:get/get.dart';

import '../modules/clustering/bindings/clustering_binding.dart';
import '../modules/clustering/views/clustering_view.dart';
import '../modules/grafik/bindings/grafik_binding.dart';
import '../modules/grafik/views/grafik_view.dart';
import '../modules/home/bindings/home_binding.dart';
import '../modules/home/views/home_view.dart';

part 'app_routes.dart';

class AppPages {
  AppPages._();

  static const INITIAL = Routes.MAINPAGE;

  static final routes = [
    GetPage(
      name: _Paths.MAINPAGE,
      page: () => MainPage(),
    ),
    GetPage(
      name: _Paths.HOME,
      page: () => const HomeView(),
      binding: HomeBinding(),
    ),
    GetPage(
      name: _Paths.CLUSTERING,
      page: () => const ClusteringView(),
      binding: ClusteringBinding(),
    ),
    GetPage(
      name: _Paths.GRAFIK,
      page: () => const GrafikView(),
      binding: GrafikBinding(),
    ),
  ];
}

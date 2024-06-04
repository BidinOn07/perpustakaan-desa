import 'package:get/get.dart';

import '../controllers/clustering_controller.dart';

class ClusteringBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<ClusteringController>(
      () => ClusteringController(),
    );
  }
}

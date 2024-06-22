import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../../../utils/theme.dart';
import '../controllers/clustering_controller.dart';

class ClusteringView extends GetView<ClusteringController> {
  const ClusteringView({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Get.lazyPut(() => ClusteringController());
    return Scaffold(
      appBar: AppBar(
        title: const Text(
          'Clustering KMeans',
          style: TextStyle(
            fontSize: 23,
            fontWeight: FontWeight.bold,
            color: kColor,
          ),
        ),
        backgroundColor: kColorInfo,
        automaticallyImplyLeading: false,
        titleSpacing: 30,
        toolbarHeight: 80,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: <Widget>[
            TextField(
              controller: controller.clustersController,
              decoration: const InputDecoration(labelText: 'Jumlah Cluster'),
              keyboardType: TextInputType.number,
            ),
            TextField(
              controller: controller.iterController,
              decoration: const InputDecoration(labelText: 'Jumlah Iterasi'),
              keyboardType: TextInputType.number,
            ),
            const SizedBox(height: 20),
            ElevatedButton(
              onPressed: controller.fetchKMeansData,
              child: const Text('Jalankan KMeans'),
            ),
            const SizedBox(height: 20),
            ElevatedButton(
              onPressed: controller.iterateKMeans,
              child: const Text('Iterasi Lagi'),
            ),
            const SizedBox(height: 20),
            Obx(() {
              if (controller.showResults.value) {
                return Expanded(
                  child: SingleChildScrollView(
                    child: Column(
                      children: [
                        const Text(
                          'Hasil Clustering:',
                          style: TextStyle(
                              fontSize: 18, fontWeight: FontWeight.bold),
                        ),
                        ListView.builder(
                          shrinkWrap: true,
                          physics: const NeverScrollableScrollPhysics(),
                          itemCount: controller.labels.length,
                          itemBuilder: (context, index) {
                            return ListTile(
                              title: Text('Point ${index + 1}'),
                              subtitle: Text(
                                  'Cluster: ${controller.labels[index]}, Coordinates: ${controller.points[index]}'),
                            );
                          },
                        ),
                        const SizedBox(height: 20),
                        const Text(
                          'Cluster Centers:',
                          style: TextStyle(
                              fontSize: 18, fontWeight: FontWeight.bold),
                        ),
                        ListView.builder(
                          shrinkWrap: true,
                          physics: const NeverScrollableScrollPhysics(),
                          itemCount: controller.centers.length,
                          itemBuilder: (context, index) {
                            return ListTile(
                              title: Text('Center ${index + 1}'),
                              subtitle: Text(
                                  'Coordinates: ${controller.centers[index]}'),
                            );
                          },
                        ),
                      ],
                    ),
                  ),
                );
              } else {
                return Container();
              }
            }),
          ],
        ),
      ),
    );
  }
}

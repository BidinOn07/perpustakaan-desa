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
        title: Text(
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
              decoration: InputDecoration(labelText: 'Jumlah Cluster'),
              keyboardType: TextInputType.number,
            ),
            TextField(
              controller: controller.iterController,
              decoration: InputDecoration(labelText: 'Jumlah Iterasi'),
              keyboardType: TextInputType.number,
            ),
            SizedBox(height: 20),
            ElevatedButton(
              onPressed: controller.fetchKMeansData,
              child: Text('Jalankan KMeans'),
            ),
            SizedBox(height: 20),
            ElevatedButton(
              onPressed: controller.iterateKMeans,
              child: Text('Iterasi Lagi'),
            ),
            SizedBox(height: 20),
            Obx(() {
              if (controller.showResults.value) {
                return Column(
                  children: [
                    Text(
                      'Hasil Clustering:',
                      style:
                          TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                    ),
                    Flexible(
                      fit: FlexFit.loose,
                      child: ListView.builder(
                        itemCount: controller.labels.length,
                        itemBuilder: (context, index) {
                          return ListTile(
                            title: Text('Point ${index + 1}'),
                            subtitle: Text(
                                'Cluster: ${controller.labels[index]}, Coordinates: ${controller.points[index]}'),
                          );
                        },
                      ),
                    ),
                    SizedBox(height: 20),
                    Text(
                      'Cluster Centers:',
                      style:
                          TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                    ),
                    Flexible(
                      fit: FlexFit.loose,
                      child: ListView.builder(
                        itemCount: controller.centers.length,
                        itemBuilder: (context, index) {
                          return ListTile(
                            title: Text('Center ${index + 1}'),
                            subtitle: Text(
                                'Coordinates: ${controller.centers[index]}'),
                          );
                        },
                      ),
                    ),
                  ],
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

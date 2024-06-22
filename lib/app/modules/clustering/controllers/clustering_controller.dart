import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'dart:convert';
import '../../../../service/kmeans_api.dart';

class ClusteringController extends GetxController {
  final TextEditingController clustersController = TextEditingController();
  final TextEditingController iterController = TextEditingController();
  RxList<int> labels = <int>[].obs;
  RxList<List<double>> centers = <List<double>>[].obs;
  List<List<double>> points = [
    [1.0, 2.0],
    [3.0, 4.0],
    [5.0, 6.0],
    [7.0, 8.0],
    [9.0, 10.0]
  ];
  RxBool showResults = false.obs;

  final ApiService apiService = ApiService();

  @override
  void onInit() {
    super.onInit();
    _loadSavedData();
  }

  Future<void> fetchKMeansData() async {
    try {
      int nClusters = int.parse(clustersController.text);
      int nIter = int.parse(iterController.text);
      Map<String, dynamic> result =
          await apiService.fetchKMeans(nClusters, nIter, points);
      labels.value = List<int>.from(result['labels']);
      centers.value = List<List<double>>.from(
        result['centers'].map((center) => List<double>.from(center)),
      );
      _saveData(nClusters, nIter, labels, centers);
      showResults.value = true;
    } catch (e) {
      print('Error: $e');
    }
  }

  Future<void> _saveData(int nClusters, int nIter, List<int> labels,
      List<List<double>> centers) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    await prefs.setInt('nClusters', nClusters);
    await prefs.setInt('nIter', nIter);
    await prefs.setString('labels', jsonEncode(labels));
    await prefs.setString('centers', jsonEncode(centers));
  }

  Future<void> _loadSavedData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    clustersController.text = (prefs.getInt('nClusters') ?? 3).toString();
    iterController.text = (prefs.getInt('nIter') ?? 100).toString();
    labels.value =
        List<int>.from(jsonDecode(prefs.getString('labels') ?? '[]'));
    centers.value = (jsonDecode(prefs.getString('centers') ?? '[]') as List)
        .map((center) => List<double>.from(center))
        .toList();
    showResults.value = labels.isNotEmpty && centers.isNotEmpty;
  }

  void iterateKMeans() {
    if (labels.isEmpty || centers.isEmpty) {
      fetchKMeansData();
    } else {
      int nClusters = int.parse(clustersController.text);
      if (labels.length < nClusters) {
        fetchKMeansData();
      } else {
        Get.dialog(
          AlertDialog(
            title: const Text('Clustering sudah optimal'),
            content: const Text('Tidak ada iterasi tambahan yang dibutuhkan.'),
            actions: <Widget>[
              TextButton(
                onPressed: () {
                  Get.back();
                },
                child: const Text('OK'),
              ),
            ],
          ),
        );
      }
    }
  }
}

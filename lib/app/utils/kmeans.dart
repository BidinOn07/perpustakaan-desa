import 'dart:math';

import 'book.dart';

class KMeansClustering {
  final int k;
  final List<Book> books;
  List<List<Book>> clusters = [];
  List<int> centroids = [];

  KMeansClustering(this.k, this.books) {
    if (k <= 0) throw Exception('K harus lebih besar dari 0');
    if (books.isEmpty) throw Exception('Daftar buku tidak boleh kosong');
    _initializeCentroids();
  }

  void _initializeCentroids() {
    Random random = Random();
    centroids =
        List.generate(k, (_) => books[random.nextInt(books.length)].readCount);
  }

  List<List<Book>> computeClusters() {
    if (books.isEmpty) {
      throw Exception('Daftar buku tidak boleh kosong');
    }
    bool shouldTerminate = false;

    while (!shouldTerminate) {
      List<List<Book>> newClusters = List.generate(k, (_) => []);

      for (var book in books) {
        var distances =
            centroids.map((c) => (c - book.readCount).abs()).toList();
        var minDistanceIndex = distances.indexOf(distances.reduce(min));
        newClusters[minDistanceIndex].add(book);
      }

      List<int> newCentroids = [];
      for (var cluster in newClusters) {
        if (cluster.isEmpty) {
          throw Exception(
              'Salah satu cluster kosong, tidak bisa menghitung centroid');
        }
        var average = cluster.map((b) => b.readCount).reduce((a, b) => a + b) ~/
            cluster.length;
        newCentroids.add(average);
      }

      shouldTerminate = true;
      for (int i = 0; i < k; i++) {
        if ((newCentroids[i] - centroids[i]).abs() > 1) {
          shouldTerminate = false;
          break;
        }
      }

      centroids = newCentroids;
      clusters = newClusters;
    }

    return clusters;
  }
}

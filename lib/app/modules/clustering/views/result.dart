import 'package:flutter/material.dart';
import '../../../utils/book.dart';

class ClusterResultsPage extends StatelessWidget {
  final List<List<Book>> clusters;

  const ClusterResultsPage({Key? key, required this.clusters})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Hasil Clustering'),
      ),
      body: ListView.builder(
        itemCount: clusters.length,
        itemBuilder: (context, index) {
          return Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text('Cluster ${index + 1}',
                  style: const TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
              DataTable(
                columns: const [
                  DataColumn(label: Text('Judul')),
                  DataColumn(label: Text('Penulis')),
                  DataColumn(label: Text('Dibaca')),
                ],
                rows: clusters[index].map((book) {
                  return DataRow(cells: [
                    DataCell(Text(book.title)),
                    DataCell(Text(book.author)),
                    DataCell(Text(book.readCount.toString())),
                  ]);
                }).toList(),
              ),
              const SizedBox(height: 20), // Spasi antar cluster
            ],
          );
        },
      ),
    );
  }
}

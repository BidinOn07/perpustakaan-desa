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
        title: Text('Hasil Clustering'),
      ),
      body: ListView.builder(
        itemCount: clusters.length,
        itemBuilder: (context, index) {
          return Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text('Cluster ${index + 1}',
                  style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
              DataTable(
                columns: [
                  DataColumn(label: Text('Title')),
                  DataColumn(label: Text('Author')),
                  DataColumn(label: Text('Read Count')),
                ],
                rows: clusters[index].map((book) {
                  return DataRow(cells: [
                    DataCell(Text(book.title)),
                    DataCell(Text(book.author)),
                    DataCell(Text(book.readCount.toString())),
                  ]);
                }).toList(),
              ),
              SizedBox(height: 20), // Spasi antar cluster
            ],
          );
        },
      ),
    );
  }
}

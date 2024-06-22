import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:clustering_apps/config/config.dart';

class ApiService {
  Future<Map<String, dynamic>> fetchKMeans(int nClusters, int nIter, List<List<double>> points) async {
    final url = Uri.parse('${Config.baseUrl}/kmeans'); 
    final response = await http.post(
      url,
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode({
        'n_clusters': nClusters,
        'n_iter': nIter,
        'points': points,
      }),
    );

    if (response.statusCode == 200) {
      return jsonDecode(response.body);
    } else {
      throw Exception('Failed to load KMeans data');
    }
  }
}

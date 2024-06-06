import 'dart:convert';
import 'package:http/http.dart' as http;

class ApiService {
  // Ganti 192.168.1.2 dengan IP address mesin host
  final String baseUrl = 'http://10.0.2.2:8000';
  //10.0.2.2:8000 emu

  Future<Map<String, dynamic>> fetchKMeans(
      int nClusters, int nIter, List<List<double>> points) async {
    final url = Uri.parse('$baseUrl/kmeans');
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

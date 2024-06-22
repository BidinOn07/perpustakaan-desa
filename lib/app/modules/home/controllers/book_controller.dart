import 'package:clustering_apps/app/modules/home/controllers/home_controller.dart';
import 'package:clustering_apps/config/config.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import '../../../utils/book.dart';

class BookController {
  Future<List<Book>> fetchBooks() async {
    final response = await http.get(Uri.parse('${Config().url}/books/'));
    if (response.statusCode == 200) {
      final List<dynamic> responseData = jsonDecode(response.body);
      return responseData.map((json) => Book.fromJson(json)).toList();
    } else {
      print('Failed to load books: ${response.statusCode}');
      print('Response body: ${response.body}');
      throw Exception('Failed to load books');
    }
  }
}

class BookList extends StatelessWidget {
  const BookList({super.key});

  @override
  Widget build(BuildContext context) {
    final HomeController homeC = Get.find<HomeController>();

    return Obx(() {
      if (homeC.filteredBooks.isEmpty) {
        return const Center(child: Text('No data available'));
      } else {
        return ListView.builder(
          itemCount: homeC.filteredBooks.length,
          itemBuilder: (context, index) {
            final book = homeC.filteredBooks[index];
            return Card(
              elevation: 2,
              margin: const EdgeInsets.all(8),
              child: ListTile(
                title: Text(book.title),
                subtitle: Text('Penulis: ${book.author}'),
                trailing: Text('Dibaca: ${book.readCount}'),
              ),
            );
          },
        );
      }
    });
  }
}

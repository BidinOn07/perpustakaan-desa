import 'package:clustering_apps/config/config.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import '../../../utils/book.dart';

class HomeController extends GetxController {
  var books = <Book>[].obs;
  var filteredBooks = <Book>[].obs;
  var searchQuery = ''.obs;
  var sortOption = ''.obs;

  TextEditingController searchController = TextEditingController();

  @override
  void onInit() {
    super.onInit();
    fetchBooks();
    searchController.addListener(() {
      searchBooks(searchController.text);
    });
  }

  Future<List<Book>> fetchBooks() async {
    final response = await http.get(Uri.parse('${Config().url}/books'));
    if (response.statusCode == 200) {
      final List<dynamic> responseData = jsonDecode(response.body);
      books.assignAll(responseData.map((json) => Book.fromJson(json)).toList());
      filteredBooks.value = books.value;
      sortBooks();
      return books;
    } else {
      print('Failed to load books: ${response.statusCode}');
      print('Response body: ${response.body}');
      throw Exception('Failed to load books');
    }
  }

  void searchBooks(String query) {
    searchQuery.value = query;
    if (query.isEmpty) {
      filteredBooks.value = books.value;
    } else {
      filteredBooks.value = books
          .where(
              (book) => book.title.toLowerCase().contains(query.toLowerCase()))
          .toList();
    }
  }

  void sortBooks() {
    if (sortOption.value == 'Sering Dibaca') {
      books.sort((a, b) => b.readCount.compareTo(a.readCount));
    } else if (sortOption.value == 'Jarang Dibaca') {
      books.sort((a, b) => a.readCount.compareTo(b.readCount));
    }
    //
  }
}

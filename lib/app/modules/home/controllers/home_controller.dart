import 'package:get/get.dart';

import '../../../utils/book.dart';

class HomeController extends GetxController {
  // Sample list of books
  final books = [
    Book(title: 'Book One', author: 'Author One', readCount: 5),
    Book(title: 'Book Two', author: 'Author Two', readCount: 2),
    Book(title: 'Book Three', author: 'Author Three', readCount: 10),
  ].obs;

  var sortOption = 'Sering Dibaca'.obs;

  void sortBooks() {
    if (sortOption.value == 'Sering Dibaca') {
      books.sort((a, b) => b.readCount.compareTo(a.readCount));
    } else if (sortOption.value == 'Jarang Dibaca') {
      books.sort((a, b) => a.readCount.compareTo(b.readCount));
    }
    update(); // Jangan lupa memanggil update jika menggunakan GetX untuk update UI
  }
}

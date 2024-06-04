import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../../utils/theme.dart';
import '../controllers/home_controller.dart';

class HomeView extends GetView<HomeController> {
  const HomeView({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    final controller = Get.put(HomeController());
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Home',
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
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.end,
              children: [
                PopupMenuButton(
                  icon: Icon(Icons.filter_alt, size: 30, color: kColorPrimary),
                  itemBuilder: (context) => [
                    PopupMenuItem(
                      value: 'Sering Dibaca',
                      child: Text('Sering Dibaca'),
                    ),
                    PopupMenuItem(
                      value: 'Jarang Dibaca',
                      child: Text('Jarang Dibaca'),
                    ),
                  ],
                  onSelected: (value) {
                    controller.sortOption.value = value;
                    controller.sortBooks(); // Pastikan fungsi ini dipanggil
                  },
                ),
              ],
            ),
          ),
          Expanded(
            child: Obx(() {
              return ListView.builder(
                itemCount: controller.books.length,
                itemBuilder: (context, index) {
                  final book = controller.books[index];
                  return Card(
                    elevation: 2,
                    margin: EdgeInsets.all(8),
                    child: ListTile(
                      title: Text(book.title),
                      subtitle: Text('Author: ${book.author}'),
                      trailing: Text('Read Count: ${book.readCount}'),
                    ),
                  );
                },
              );
            }),
          ),
        ],
      ),
    );
  }
}

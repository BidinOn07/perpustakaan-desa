import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../../utils/theme.dart';
import '../controllers/book_controller.dart';
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
              children: [
                Expanded(
                  child: TextField(
                    controller: controller.searchController,
                    decoration: InputDecoration(
                      hintText: 'Cari',
                      prefixIcon: Icon(Icons.search, color: kColorPrimary),
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(8.0),
                        borderSide: BorderSide.none,
                      ),
                      filled: true,
                      fillColor: Colors.grey[200],
                    ),
                  ),
                ),
                SizedBox(width: 8.0),
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
                    controller.sortBooks();
                  },
                ),
              ],
            ),
          ),
          Expanded(
            child: BookList(),
          ),
        ],
      ),
    );
  }
}

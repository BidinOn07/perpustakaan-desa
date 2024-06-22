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
        title: const Text(
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
                      prefixIcon: const Icon(Icons.search, color: kColorPrimary),
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(8.0),
                        borderSide: BorderSide.none,
                      ),
                      filled: true,
                      fillColor: Colors.grey[200],
                    ),
                  ),
                ),
                const SizedBox(width: 8.0),
                PopupMenuButton(
                  icon: const Icon(Icons.filter_alt, size: 30, color: kColorPrimary),
                  itemBuilder: (context) => [
                    const PopupMenuItem(
                      value: 'Sering Dibaca',
                      child: Text('Sering Dibaca'),
                    ),
                    const PopupMenuItem(
                      value: 'Jarang Dibaca',
                      child: Text('Jarang Dibaca'),
                    ),
                  ],
                  onSelected: (value) {
                    controller.sortOption.value = value.toString();
                    controller.sortBooks();
                  },
                ),
              ],
            ),
          ),
          const Expanded(
            child: BookList(),
          ),
        ],
      ),
    );
  }
}

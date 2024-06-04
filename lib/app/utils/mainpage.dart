import 'package:clustering_apps/app/modules/clustering/views/clustering_view.dart';
import 'package:clustering_apps/app/modules/grafik/views/grafik_view.dart';
import 'package:clustering_apps/app/modules/home/views/home_view.dart';
import 'package:clustering_apps/app/utils/theme.dart';
import 'package:curved_navigation_bar/curved_navigation_bar.dart';
import 'package:flutter/material.dart';

class MainPage extends StatefulWidget {
  const MainPage({super.key});

  @override
  State<MainPage> createState() => _MainPageState();
}

class _MainPageState extends State<MainPage> {
  int _pageIndex = 0;
  List<Widget> _pages = [
    HomeView(),
    ClusteringView(),
    GrafikView(),
  ];
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: IndexedStack(
        index: _pageIndex,
        children: _pages,
      ),
      bottomNavigationBar: CurvedNavigationBar(
        backgroundColor: Colors.transparent,
        color: kColorPrimary,
        buttonBackgroundColor: kColorPrimary,
        height: 70,
        items: <Widget>[
          Icon(
            Icons.home,
            size: 30,
            color: Colors.white,
          ),
          Icon(
            Icons.table_chart,
            size: 30,
            color: Colors.white,
          ),
          Icon(
            Icons.history_edu,
            size: 30,
            color: Colors.white,
          ),
        ],
        onTap: (index) {
          setState(() {
            _pageIndex = index;
          });
        },
      ),
    );
  }
}

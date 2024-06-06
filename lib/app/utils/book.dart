class Book {
  final int id;
  final String title;
  final String author;
  final String yearPublished;
  final String readCount;

  Book({
    required this.id,
    required this.title,
    required this.author,
    required this.yearPublished,
    required this.readCount,
  });

  factory Book.fromJson(Map<String, dynamic> json) {
    return Book(
      id: json['id'],
      title: json['title'],
      author: json['author'],
      yearPublished: json['year_published'],
      readCount: json['read_count'],
    );
  }
}

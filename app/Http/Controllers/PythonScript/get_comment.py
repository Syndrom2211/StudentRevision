from lxml import etree
import zipfile
import sys

ooXMLns = {'w':'http://schemas.openxmlformats.org/wordprocessingml/2006/main'}

def get_comments(docxFileName):
  docxZip = zipfile.ZipFile(docxFileName)
  commentsXML = docxZip.read('word/comments.xml')
  et = etree.XML(commentsXML)
  comments = et.xpath('//w:comment',namespaces=ooXMLns)
 
  # tampung = []
  for c in comments:
    # attributes:
    # print(c.xpath('@w:author',namespaces=ooXMLns))
    # print(c.xpath('@w:date',namespaces=ooXMLns))
    # string value of the comment:
    kumpul = c.xpath('string(.)',namespaces=ooXMLns)
    # tampung.append(kumpul)
    print(kumpul)
  #print(tampung)

get_comments(sys.argv[1])
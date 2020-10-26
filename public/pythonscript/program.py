import win32com.client as win32
import pandas as pd
import csv
import jellyfish
import os
import numpy as np
import string
from sklearn import tree
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
#from sklearn.metrics import accuracy_score

# 1. Persiapan Data Training
filepath = 'c:\\DT\\listdokumen.txt'
with open(filepath) as fp:
   line = fp.readline()
   cnt = 0
   print("Membuat data training...")
   while line: 
        namadokumen = "{}".format(line.strip()) 
        
        print("Memproses dokumen" + namadokumen + "...")
        app = win32.Dispatch('Word.Application')
        doc = app.Documents.Open('c:\\DT\\' + namadokumen + '')
        #print(doc.Range.Text)
        
        for c in doc.Comments: 
            if c.Ancestor is None: #checking if this is a top-level comment
                df = pd.DataFrame({'index_dokumen': ['' + str(cnt) + ''],
                                        'komentar': ['' + c.Range.Text + ''],
                                        'teks_komentar': ['' + c.Scope.Text + ''],
                                        'label': [' ']}) #label isi manual
                #print("Comment by: " + c.Author)
                df.to_csv('c:\\DT\\results.csv', index=False, mode='a', header=False, sep=';') #default mode is 'w' 

        #app.Quit()
        line = fp.readline()
        cnt += 1    
       
while True:
    # some code here
    if input('Do You Want To Continue? ') != 'y':
        break

# =========== PREPROCESSING ===========
file_loc    = open('C:\\DT\\results.csv', encoding='utf8')
wkb         = csv.reader(file_loc, delimiter=';')

#Tampungan
listnya_komentar = []
listnya_tekskomentar = []
listnya_cl     = []
listnya_ncl    = []
listnya_ncrl   = []
listnya_ld     = []
listnya_crl    = []
listnya_kk     = []
listnya_gk     = []
listnya_label  = []

for line in wkb:
    #1. Kalimat / Sentence Split
    komentar = line[1]
    teks_komentar = line[2]
    label = line[3]
    listnya_komentar.append(komentar)
    listnya_tekskomentar.append(teks_komentar)
    listnya_label.append(label)

    #2. Kata / Tokenization
    #2.1 StopWord
    factory = StopWordRemoverFactory()
    stopword = factory.create_stop_word_remover()
    kalimat = '' + line[1] + ''
    kalimatdua = '' + line[2] + ''
    stopwordnya = stopword.remove(kalimat)
    stopwordnyaa = stopword.remove(kalimatdua)

    #2.2 Punctuation
    punctuationnya = stopwordnya.translate(str.maketrans('', '', string.punctuation))
    punctuationnyaa = stopwordnyaa.translate(str.maketrans('', '', string.punctuation))

    #2.3 Stemming
    factory = StemmerFactory()
    stemmer = factory.create_stemmer()
    stemmingnya = stemmer.stem(punctuationnya)
    stemmingnyaa = stemmer.stem(punctuationnyaa)

    #2.4 Token Split
    token_cl = stemmingnya.split()
    token_crl = stemmingnyaa.split()

    print(token_crl)

    #3. Panjang Komentar / Comment Length
    comment_length = len(token_cl)
    listnya_cl.append(comment_length)
    
    #4. Jumlah Jarak Komentar / Comment Range Length
    comment_range_length = len(token_crl)
    listnya_crl.append(comment_range_length)

#~Normalisasi Comment Length
inisialisasi_min_cl = min(listnya_cl)
inisialisasi_max_cl = max(listnya_cl)
for index, x in enumerate(listnya_cl):
    normalisasi_cl = (listnya_cl[index]-inisialisasi_min_cl)/(inisialisasi_max_cl-inisialisasi_min_cl)
    listnya_ncl.append(normalisasi_cl)

#~Normalisasi Comment Range Length
inisialisasi_min_crl = min(listnya_crl)
inisialisasi_max_crl = max(listnya_crl)
for index, x in enumerate(listnya_crl):
    normalisasi_crl = (listnya_crl[index]-inisialisasi_min_crl)/(inisialisasi_max_crl-inisialisasi_min_crl)
    listnya_ncrl.append(normalisasi_crl)
# =========== PREPROCESSING ===========

# =========== EKSTRAKSI FITUR ===========
#5. Edit Distance / Levenshtein Distance / Jaro Winkle Distance
for index_ld, i in enumerate(listnya_komentar):
    l_distance = jellyfish.jaro_distance(u'' + listnya_komentar[index_ld] + '', u'' + listnya_tekskomentar[index_ld] +'')
    listnya_ld.append(l_distance)

#6. Content Keywords
# Mencocokan kata kunci dengan komentar
# Membaca dari file kata kunci konten
fname = os.path.join("data", "earthpy-downloads",
                        "C:\\DT\\kkkonten.txt")
ya = np.genfromtxt(fname, dtype='str')
total_kk = len(ya)

for loop_komentar, yax in enumerate(listnya_komentar):
    for index_cari, y in enumerate(ya):   
        a = ya[index_cari] in listnya_komentar[loop_komentar]
        #print("Check if "+ya[index_cari]+" contains "+listnya_komentar[loop_komentar]+":") 
        if a == True:
            kontenkeywords = 1
            listnya_kk.append(kontenkeywords)
            #print("ok")
            break
        else:
            if index_cari == (total_kk-1):
                kontenkeywords = 0
                listnya_kk.append(kontenkeywords)
            else:
                kontenkeywords = 0
                #listnya_kk.append(kontenkeywords)

#7. Grammatical Keywords
# Mencocokan kata kunci dengan komentar
# Membaca dari file kata kunci konten
fname = os.path.join("data", "earthpy-downloads",
                        "C:\\DT\\kkgrammar.txt")
yaa = np.genfromtxt(fname, dtype='str', delimiter='\n')
total_kkg = len(yaa)

for loop_komentarr, yaxx in enumerate(listnya_komentar):
    for index_carii, yy in enumerate(yaa):   
        a = yaa[index_carii] in listnya_komentar[loop_komentarr]
        #print("Check if "+yaa[index_carii]+" contains "+listnya_komentar[loop_komentarr]+":") 
        if a == True:
            grammarkeywords = 1
            listnya_gk.append(grammarkeywords)
            #print("ok")
            break
        else:
            if index_carii == (total_kkg-1):
                grammarkeywords = 0
                listnya_gk.append(grammarkeywords)
            else:
                grammarkeywords = 0
                #listnya_kk.append(kontenkeywords)
# =========== FITUR ===========

print("Preprocessing Sentence Split Berhasil...")
print("Preprocessing Tokenisasi Berhasil...")
print("Ekstraksi Fitur Comment Length Berhasil...")
print("Ekstraksi Fitur Comment Range Length Berhasil...")
print("Normalisasi Comment Length Berhasil...")
print("Normalisasi Comment Range Length Berhasil...")
print("Normalisasi Jaro Winkle Distance Berhasil...")
print("Checking Kata Kunci Konten Berhasil...")
print("Checking Kata Kunci Grammar Berhasil...")
print("Tahapan preprocessing dan ekstraksi fitur selesai...")
print("Membuat pemetaan...")
print("Menampilkan pemetaan...")
print("Proses training selesai...")
print("Model berhasil dibuat...")
print("Klasifikasi komentar (testing)...")
print("Menampilkan hasil klasifikasi...")
print("\n")

#Menampilkan pemetaan
data = list([
    listnya_ncl,
    listnya_ncrl,
    listnya_ld,
    listnya_kk,
    listnya_gk
])
transform_xdany = np.transpose(data)

#DECISION TREE
clf = tree.DecisionTreeClassifier()
clf = clf.fit(transform_xdany, listnya_label)

#Data Testing
a = clf.predict([[1, 1, 1, 1, 0.9834747]])
b = clf.predict([[0.77364, 1, 1, 1, 0.43534]])
c = clf.predict([[0.112234, 1, 1, 1, 1]])

#Tampil Pohon
tampil_pohon = tree.plot_tree(clf)
print(a)
print(b)
print(c)
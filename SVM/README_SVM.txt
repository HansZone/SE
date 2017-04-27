README_SVM

1. There are 6 .m file in SVM directory. We use MATLAB as programming tools for our SVM algorithm. There are also 10 .csv 
   files which corresponding to 10 stoks jistorical price respectively. 
2. For running these code, you just need to open main.m and choose which stock you want to predict. You can modify the
   string in line 8 to the csv filename of certain stock.  
3. In MATLAB, we use SPIDER toolbox, here is the download URL:
   http://people.kyb.tuebingen.mpg.de/spider/
   Then extract them into matlab_path/toolbox directory.
4. The result you can see is the pattern for the stock you choose in 200 recent days. According this pattern, the program
   provide a suggestion: sell or buy.
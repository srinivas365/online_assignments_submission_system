import survey
import math
import matplotlib.pyplot as mp
def list_count(records,attribute,value):
    count=0
    for x in records:
        if getattr(x,attribute)==value:
            count+=1
    return count
    
def mean(records):
    return float(sum(records)/len(records))

def variance(records,mn=None):
    if mn==None:
        mn=mean(records)
    records=[(x-mn)*(x-mn) for x in records]
    return float(sum(records)/len(records))
    
def stand_dev(var):
    return math.sqrt(var)

table = survey.Pregnancies()
table.ReadRecords()
print ('Number of pregnancies', len(table.records))
a=table.records
print(list_count(a,"outcome",1))

first_count=0
other_count=0

first_gest_list=[]
other_gest_list=[]
for x in a:
    if x.outcome==1:
        if x.birthord==1:
            first_count+=1
            first_gest_list.append(x.prglength)
        else:
            other_count+=1
            other_gest_list.append(x.prglength)
print("first_count:{0}\nother_count:{1}".format(first_count,other_count))
print("mean of first babies gestination period:{0}\nmean of other babies gestination period:{1}".format(mean(first_gest_list),mean(other_gest_list)))
print("variance of first babies gestination period:{0}\nvariance of other babies gestination period:{1}".format(variance(first_gest_list),variance(other_gest_list)))
print("standard deviation of first babies gestination period:{0}\nstandard deviation of other babies gestination period:{1}".format(stand_dev(variance(first_gest_list)),stand_dev(variance(other_gest_list))))


#plotting first birth frequency and other birth frequency
hist_first={}
hist_sec={}
for x,y in zip(first_gest_list,other_gest_list):
    hist_first[x]=hist_first.get(x,0)+1
    hist_sec[y]=hist_sec.get(y,0)+1

for x in hist_first.keys():
    print(x,":",hist_first[x])


x=hist_first.keys()
y=hist_first.values()

mp.bar(x,y)
mp.show()







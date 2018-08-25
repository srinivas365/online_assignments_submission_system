import csv
class Respondents(object):
    def __init__(self):
        self.records=[]
    def addRecord(self,record):
        self.records.append(record)


class Table(object):
    def __init__(self):
        self.fields=[]
        self.filename=None
        self.respo=Respondents()
    def readFile(self,filename):
        self.filename=filename
        with open(filename) as f:
            reader=csv.reader(f)
            self.fields=next(reader)
    def makeRecords(self):
        with open(self.filename) as f:
            reader=csv.reader(f)
            for x in reader:
                resp=Respondents()
                for p,q in zip(x,self.fields):
                    setattr(resp,q,p)
                self.respo.addRecord(resp)
        return self.respo


if __name__=='__main__':
    a=Table()
    a.readFile('sample.csv')
    k=a.makeRecords()
    print('hello world')
    for x in k.records:
        print(x.policyID)
    


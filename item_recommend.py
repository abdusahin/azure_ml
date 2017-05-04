########### Python 2.7 #############
import httplib, urllib, base64
import sys, getopt
import os

def main(argv):

    model = '',
    key = ''
    build = ''
    item = ''
    try:
        opts, args = getopt.getopt(argv,"hm:k:i:b:",["model=","key=", "item=", "build="])
    except getopt.GetoptError:
        print 'item_recommend.py -m <model> -k <key> -b <build> -i <product id>'
        sys.exit(2)

    for opt, arg in opts:
        if opt in ("-m", "--model"):
            model = arg
        elif opt in ("-k", "--key"):
            key = arg
        elif opt in ("-i", "--item"):
            item = arg
        elif opt in ("-b", "--build"):
            build = arg


    if model=='' or key=='' or item == '' or build == '':
        print 'item_recommend.py -m <model> -k <key> -b <build> -i <product id>'
        sys.exit(2)

    headers = {
        # Request headers
        'Content-Type': 'application/json',
        'Ocp-Apim-Subscription-Key': key,
    }

    params = urllib.urlencode({
        # Request parameters
        'includeMetadata': 'false',
        'buildId': build,
    })

    try:
        url = "/recommendations/v4.0/models/%s/recommend/item?itemIds=%s&numberOfResults=2&minimalScore=60&%s" % (model, item, params)
        print("URL is %s" % url)
        conn = httplib.HTTPSConnection('westus.api.cognitive.microsoft.com')
        conn.request("GET", url, '' , headers)
        response = conn.getresponse()
        data = response.read()
        print(data)
        conn.close()

    except Exception as e:
        print("[Errno {0}] {1}".format(e, e))



if __name__ == "__main__":
    main(sys.argv[1:])